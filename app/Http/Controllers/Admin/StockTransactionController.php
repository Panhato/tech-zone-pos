<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Notifications\LowStockNotification; // បន្ថែមថ្មី
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification; // បន្ថែមថ្មី

class StockTransactionController extends Controller
{
    public function create()
    {
        $products = Product::orderBy('name')->get();
        return view('admin.transactions.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type'       => 'required|in:in,broken',
            'quantity'   => 'required|integer|min:1',
            'note'       => 'nullable|string',
        ]);

        // បង្កើត Variable ដើម្បីទុក Product សម្រាប់ប្រើក្រៅ Transaction
        $updatedProduct = null;

        DB::transaction(function () use ($request, &$updatedProduct) {
            // ១. បង្កើតកំណត់ត្រាប្រតិបត្តិការ
            StockTransaction::create([
                'product_id' => $request->product_id,
                'quantity'   => $request->quantity,
                'type'       => $request->type,
                'note'       => $request->note,
                'user_id'    => Auth::id(),
            ]);

            // ២. ធ្វើបច្ចុប្បន្នភាពចំនួនក្នុងស្តុកទំនិញ
            $product = Product::lockForUpdate()->find($request->product_id);
            
            if ($request->type == 'in') {
                $product->increment('qty', $request->quantity);
            } elseif ($request->type == 'broken') {
                $product->decrement('qty', $request->quantity);
            }

            $updatedProduct = $product;
        });

        // ៣. ពិនិត្យមើលបើស្តុកនៅសល់តិច (ក្រោម ៥) ផ្ញើសារទៅ Telegram
        if ($updatedProduct && $updatedProduct->qty <= 5) {
            try {
                // ផ្ញើទៅកាន់អ្នកដែលកំពុងប្រើប្រាស់ (Admin)
                Auth::user()->notify(new LowStockNotification($updatedProduct));
            } catch (\Exception $e) {
                // ប្រសិនបើមានបញ្ហាជាមួយ Telegram API មិនឱ្យវាគាំងប្រព័ន្ធទេ
                \Log::error("Telegram Notification Error: " . $e->getMessage());
            }
        }

        return redirect()->route('admin.reports.transactions')->with('success', 'ប្រតិបត្តិការស្តុកត្រូវបានរក្សាទុក និងត្រួតពិនិត្យរួចរាល់!');
    }
}