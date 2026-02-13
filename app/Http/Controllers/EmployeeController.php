<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User; // ១. ហៅ Model User មកប្រើ
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // ២. សម្រាប់ Hash Password
use Illuminate\Support\Facades\DB;   // ៣. សម្រាប់ Transaction

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::latest()->paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        // ៤. Validate ទាំងព័ត៌មានបុគ្គលិក និងគណនី Login
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users', // ហាមជាន់ Email គ្នា
            'password' => 'required|string|min:8', // Password យ៉ាងតិច ៨ ខ្ទង់
        ]);

        // ៥. ប្រើ Transaction ដើម្បីធានាថាទិន្នន័យចូលទាំងពីរតារាង
        DB::transaction(function () use ($request) {
            
            // ជំហានទី ១: បង្កើតគណនី User ថ្មី
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'admin', // កំណត់សិទ្ធិ (អាចប្តូរតាមចិត្ត)
            ]);

            // ជំហានទី ២: បង្កើត Employee ហើយភ្ជាប់ user_id
            Employee::create([
                'name' => $request->name,
                'position' => $request->position,
                'phone' => $request->phone,
                'user_id' => $user->id, // ភ្ជាប់ ID របស់ User នៅទីនេះ
            ]);
        });

        return redirect()->route('employees.index')->with('success', 'បន្ថែមបុគ្គលិក និងបង្កើតគណនីជោគជ័យ!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $employee = Employee::findOrFail($id);
        
        // Update ព័ត៌មានបុគ្គលិក
        $employee->update([
            'name' => $request->name,
            'position' => $request->position,
            'phone' => $request->phone,
        ]);

        // (Optional) Update ឈ្មោះក្នុង User ផងដែរ បើចង់ឱ្យដូចគ្នា
        if ($employee->user) {
            $employee->user->update(['name' => $request->name]);
        }

        return redirect()->route('employees.index')->with('success', 'កែប្រែព័ត៌មានបុគ្គលិកជោគជ័យ!');
    }

    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);
        
        // ពេលលុបបុគ្គលិក តើចង់លុបគណនី User ដែរឬទេ?
        // បើចង់លុបទាំងពីរ សូមបើកកូដខាងក្រោម៖
        /*
        if ($employee->user) {
            $employee->user->delete();
        }
        */

        $employee->delete();

        return redirect()->route('employees.index')->with('success', 'លុបបុគ្គលិកជោគជ័យ!');
    }
}