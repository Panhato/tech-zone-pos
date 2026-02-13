<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position; // ត្រូវប្រាកដថាបានបង្កើត Model នេះរួចរាល់
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * បង្ហាញបញ្ជីឈ្មោះតំណែងបុគ្គលិកទាំងអស់
     */
    public function index()
    {
        // ទាញយកតំណែងទាំងអស់ដោយតម្រៀបពីថ្មីទៅចាស់
        $positions = Position::latest()->get(); 
        
        return view('admin.positions.index', compact('positions'));
    }

    /**
     * រក្សាទុកតំណែងថ្មីចូលក្នុង Database
     */
    public function store(Request $request)
    {
        // ត្រួតពិនិត្យទិន្នន័យដែលបញ្ចូលមក (Validation)
        $request->validate([
            'name' => 'required|unique:positions,name|max:255',
            'description' => 'nullable|string'
        ]);

        // បង្កើតតំណែងថ្មី
        Position::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'បន្ថែមតំណែងថ្មីបានជោគជ័យ!');
    }

    /**
     * កែប្រែព័ត៌មានតំណែង (Update)
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|max:255|unique:positions,name,' . $position->id,
        ]);

        $position->update($request->all());

        return redirect()->back()->with('success', 'បច្ចុប្បន្នភាពតំណែងបានជោគជ័យ!');
    }

    /**
     * លុបតំណែងចេញពីប្រព័ន្ធ
     */
    public function destroy(Position $position)
    {
        // អ្នកអាចបន្ថែមលក្ខខណ្ឌមិនឱ្យលុប ប្រសិនបើមានបុគ្គលិកកំពុងប្រើតំណែងនេះ
        $position->delete();

        return redirect()->back()->with('success', 'លុបតំណែងបានជោគជ័យ!');
    }
}