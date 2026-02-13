<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name|max:255']);
        Category::create($request->all());
        return back()->with('success', 'ប្រភេទថ្មីត្រូវបានបន្ថែម!');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|max:255|unique:categories,name,'.$category->id]);
        $category->update($request->all());
        return back()->with('success', 'ការកែប្រែបានជោគជ័យ!');
    }

    public function destroy(Category $category)
    {
        if($category->products()->count() > 0) {
            return back()->with('error', 'មិនអាចលុបបានទេ ព្រោះមានទំនិញក្នុងប្រភេទនេះ!');
        }
        $category->delete();
        return back()->with('success', 'លុបប្រភេទបានជោគជ័យ!');
    }
}