<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // សម្រាប់លុបរូបភាព
use Illuminate\Support\Facades\DB;      // សម្រាប់ឆែក Database

class ProductController extends Controller
{
    /**
     * បង្ហាញបញ្ជីទំនិញ (ប្រើបានទាំង Admin និង Shop)
     */
    public function index(Request $request) 
    {
        // ១. ចាប់ផ្តើម Query
        $query = Product::with('category');

        // ២. លក្ខខណ្ឌស្វែងរក (Search)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('brand', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // ៣. លក្ខខណ្ឌចម្រាញ់តាមប្រភេទ (Category Filter)
        if ($request->filled('category')) {
             $query->where('category_id', $request->category);
        }

        // ៤. ទាញយកទិន្នន័យ (Pagination)
        $products = $query->latest()->paginate(20);

        // ៥. ទាញយក Categories សម្រាប់ Sidebar
        $categories = Category::withCount('products')->get();

        // ៦. [ចំណុចសំខាន់] ឆែកមើលថាតើអ្នកប្រើកំពុងចូលតាម Admin ឬ Public?
        if ($request->routeIs('admin.*')) {
            // បើជា Admin ឱ្យទៅកាន់ Admin View
            return view('admin.products.index', compact('products'));
        }

        // បើជាភ្ញៀវ ឱ្យទៅកាន់ Shop View
        return view('shop.index', compact('products', 'categories'));
    }

    /**
     * បង្ហាញ Form បង្កើតទំនិញ (Admin)
     */
    public function create()
    {
        $categories = Category::all();
        $suppliers = \App\Models\Supplier::all(); // ប្រសិនបើមាន
        return view('admin.products.create', compact('categories', 'suppliers'));
    }

    /**
     * រក្សាទុកទំនិញថ្មី (Admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'category_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Upload Image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'បង្កើតទំនិញជោគជ័យ!');
    }

    /**
     * បង្ហាញ Form កែប្រែ (Admin)
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $suppliers = \App\Models\Supplier::all();
        return view('admin.products.edit', compact('product', 'categories', 'suppliers'));
    }

    /**
     * Update ទំនិញ (Admin)
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'category_id' => 'required',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // លុបរូបចាស់
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
            // ដាក់រូបថ្មី
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'កែប្រែទំនិញជោគជ័យ!');
    }

    /**
     * លុបទំនិញ (Admin) - ដោះស្រាយបញ្ហាជាប់ Order
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // ១. ឆែកមើលថាតើទំនិញនេះមានគេធ្លាប់កម្មង់ឬនៅ?
        // (សន្មតថាអ្នកមាន table 'order_items')
        $hasOrders = DB::table('order_items')->where('product_id', $product->id)->exists();

        if ($hasOrders) {
            return back()->with('error', 'មិនអាចលុបបានទេ! ទំនិញនេះមានក្នុងប្រវត្តិការលក់។ សូមគ្រាន់តែបិទ (Disable) ឬកែស្តុកជា 0 វិញ។');
        }

        // ២. លុបរូបភាពចេញពី Storage
        if ($product->image && Storage::exists('public/' . $product->image)) {
            Storage::delete('public/' . $product->image);
        }

        // ៣. លុបទិន្នន័យ
        $product->delete();

        return back()->with('success', 'លុបទំនិញជោគជ័យ!');
    }
}