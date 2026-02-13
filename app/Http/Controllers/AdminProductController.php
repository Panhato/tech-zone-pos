<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB; // Added for database checks

class AdminProductController extends Controller
{
    /**
     * List products for admin panel
     */
    public function index(Request $request)
    {
        $query = Product::with(['category', 'supplier']);

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('name', 'like', "%{$term}%")
                  ->orWhere('brand', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%");
            });
        }

        $products = $query->latest()->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    /**
     * Store a new product
     */
    public function store(Request $request)
    {
        // 1. Validation (Added Promotion Fields)
        $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            'price'             => 'required|numeric|min:0',
            'category_id'       => 'required|exists:categories,id',
            'supplier_id'       => 'nullable|exists:suppliers,id',
            'image'             => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'       => 'nullable|string',
            'brand'             => 'nullable|string|max:100',
            'qty'               => 'nullable|integer|min:0',
            // Promotion Validation
            'discount_percent'  => 'nullable|integer|min:0|max:100',
            'discount_end_date' => 'nullable|date|after_or_equal:today',
        ]);

        // 2. Handle Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate unique filename
            $fileName = 'prod_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Store in storage/app/public/products
            $image->storeAs('products', $fileName, 'public');
            
            $validatedData['image'] = $fileName;
        }

        // 3. Create Product
        Product::create($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'ទំនិញថ្មីត្រូវបានបញ្ចូលជោគជ័យ!');
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers = Supplier::all();
        return view('admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update product
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Validation (Added Promotion Fields)
        $validatedData = $request->validate([
            'name'              => 'required|string|max:255',
            'price'             => 'required|numeric|min:0',
            'category_id'       => 'required|exists:categories,id',
            'supplier_id'       => 'nullable|exists:suppliers,id',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description'       => 'nullable|string',
            'brand'             => 'nullable|string|max:100',
            'qty'               => 'nullable|integer|min:0',
            // Promotion Validation
            'discount_percent'  => 'nullable|integer|min:0|max:100',
            'discount_end_date' => 'nullable|date|after_or_equal:today',
        ]);

        // 2. Handle Image Update
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
                Storage::disk('public')->delete('products/' . $product->image);
            }

            // Upload new image
            $image = $request->file('image');
            $fileName = 'prod_' . time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $fileName, 'public');

            $validatedData['image'] = $fileName;
        } else {
            unset($validatedData['image']); 
        }

        // 3. Update Product
        $product->update($validatedData);

        return redirect()->route('admin.products.index')->with('success', 'ទំនិញត្រូវបានកែប្រែដោយជោគជ័យ!');
    }

    /**
     * Delete product (Safe Delete)
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // 1. Check for existing orders to prevent Foreign Key Error
        // Assuming your order items table is named 'order_items'
        $hasOrders = DB::table('order_items')->where('product_id', $product->id)->exists();

        if ($hasOrders) {
            return back()->with('error', 'មិនអាចលុបបានទេ! ទំនិញនេះមានក្នុងប្រវត្តិការលក់។ សូមគ្រាន់តែបិទ (Disable) ឬកែស្តុកជា 0 វិញ។');
        }

        // 2. Delete Image (Only if not using SoftDeletes, or force deleting)
        if ($product->image && Storage::disk('public')->exists('products/' . $product->image)) {
            Storage::disk('public')->delete('products/' . $product->image);
        }

        // 3. Delete Record
        $product->delete();

        return back()->with('success', 'ទំនិញត្រូវបានលុបជោគជ័យ!');
    }
}   