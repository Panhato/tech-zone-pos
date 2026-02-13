<?php

namespace App\Http\Controllers;

use App\Models\Supplier; // Import Model មកប្រើនៅទីនេះ
use App\Models\Product;  // Import Product ដើម្បីឆែកមុនលុប
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * បង្ហាញតារាងបញ្ជីអ្នកផ្គត់ផ្គង់
     */
    public function index() 
    {
        $suppliers = Supplier::latest()->paginate(10);
        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * បង្ហាញទម្រង់បង្កើតថ្មី
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * រក្សាទុកទិន្នន័យថ្មី (Create)
     */
    public function store(Request $request) 
    {
        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'nullable|string',
        ]);

        Supplier::create($data);

        return redirect()->route('admin.suppliers.index')->with('success', 'បន្ថែមអ្នកផ្គត់ផ្គង់ជោគជ័យ!');
    }

    /**
     * បង្ហាញទម្រង់កែប្រែ (Edit)
     */
    public function edit(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * រក្សាទុកការកែប្រែ (Update)
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'nullable|string',
        ]);

        $supplier->update($data);

        return redirect()->route('admin.suppliers.index')->with('success', 'កែប្រែព័ត៌មានជោគជ័យ!');
    }

    /**
     * លុបទិន្នន័យ (Delete)
     * ដោះស្រាយបញ្ហាអេក្រង់ស និងការលុបមិនបាន
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);

        // ១. ការពារ៖ ឆែកមើលថាក្រុមហ៊ុននេះមានផ្គត់ផ្គង់ទំនិញដែរឬទេ?
        $productCount = Product::where('supplier_id', $supplier->id)->count();

        if ($productCount > 0) {
            return back()->with('error', 'មិនអាចលុបបានទេ! ក្រុមហ៊ុននេះកំពុងផ្គត់ផ្គង់ទំនិញចំនួន ' . $productCount . ' មុខ។ សូមលុបទំនិញទាំងនោះជាមុនសិន។');
        }

        // ២. លុប
        $supplier->delete();

        // ៣. បញ្ជូនត្រឡប់ទៅវិញ
        return redirect()->route('admin.suppliers.index')->with('success', 'លុបក្រុមហ៊ុនផ្គត់ផ្គង់ជោគជ័យ!');
    }
}