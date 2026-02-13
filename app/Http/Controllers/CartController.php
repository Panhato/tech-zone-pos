<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;       
use App\Models\OrderItem;   
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // --- មុខងារបន្ថែមទំនិញចូលកន្ត្រក ---
    public function addToCart($id)
    {
        // ឆែកមើលថាផលិតផលមានពិតមែនឬអត់
        $product = Product::find($id);

        if(!$product) {
            return redirect()->back()->with('error', 'រកមិនឃើញផលិតផលនេះទេ!');
        }

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "brand" => $product->brand,
                "image" => $product->image ?? null
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'បានបន្ថែមចូលកន្ត្រក!');
    }

    // --- មុខងារមើលកន្ត្រក ---
    public function cart()
    {
        return view('cart');
    }

    // --- មុខងារលុបទំនិញពីកន្ត្រក ---
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'បានលុបទំនិញចេញជោគជ័យ!');
        }
        return redirect()->back();
    }

    // --- ១. បង្ហាញទម្រង់បំពេញព័ត៌មាន (Checkout Page) ---
    public function showCheckout()
    {
        $cart = session()->get('cart');
        
        if(!$cart) {
            return redirect()->route('shop.index')->with('error', 'កន្ត្រករបស់អ្នកទទេ!');
        }

        return view('checkout');
    }

    // --- ២. ទទួលទិន្នន័យពី Form ហើយបញ្ជូនទៅ Database (Place Order) ---
    public function placeOrder(Request $request)
    {
        // Validate ទិន្នន័យ
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required'
        ]);

        $cart = session()->get('cart');

        if(!$cart) {
            return redirect()->back()->with('error', 'កន្ត្រកទទេ!');
        }

        // គណនាតម្លៃសរុប (Total Calculation)
        $total = 0;
        foreach($cart as $details) {
            $total += $details['price'] * $details['quantity'];
        }

        // បង្កើត Order ថ្មី
        $order = Order::create([
            'user_id' => Auth::id() ?? null,
            'customer_name' => $request->name,       
            'customer_phone' => $request->phone,     
            'customer_address' => $request->address, 
            'total_price' => $total,
            'status' => 'pending'
        ]);

        // បញ្ចូលទំនិញនីមួយៗទៅក្នុង OrderItems (ការពារ Error)
        foreach($cart as $id => $details) {
            
            // ឆែកមើលថាតើផលិតផលពិតជាមានក្នុង Database ឬអត់?
            // (ការពារករណីផលិតផលត្រូវបានលុបចោល ប៉ុន្តែនៅសល់ក្នុងកន្ត្រក)
            $productExists = Product::find($id);

            if ($productExists) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'product_name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price']
                ]);
            }
        }

        // លុប Session Cart ចោល
        session()->forget('cart');

        return redirect()->route('order.history')->with('success', 'ការកុម្ម៉ង់បានជោគជ័យ!');
    }

    // --- មុខងារមើលប្រវត្តិការទិញ (History) ---
    public function history()
    {
        $orders = Order::with('items')->latest()->get(); 
        return view('orders.history', compact('orders'));
    }
}