<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * បង្ហាញបញ្ជីអតិថិជនទាំងអស់ (Role: user)
     */
    public function index()
    {
        // ទាញយកអ្នកប្រើប្រាស់ដែលមាន role ជា 'user' និងរាប់ចំនួន order របស់ពួកគេ
        $customers = User::where('role', 'user')
            ->withCount('orders')
            ->latest()
            ->get();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * បង្ហាញព័ត៌មានលម្អិត និងប្រវត្តិទិញរបស់អតិថិជនម្នាក់ៗ
     */
    public function show(User $user)
    {
        // ប្រើ with(['items.product']) ដើម្បីទាញយកទិន្នន័យទំនិញ និងព័ត៌មានផលិតផលក្នុងពេលតែមួយ
        // ការធ្វើបែបនេះនឹងដោះស្រាយបញ្ហា "Unknown Product" និងធ្វើឱ្យរូបភាពបង្ហាញមកវិញ
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product']) 
            ->latest()
            ->get();

        return view('admin.customers.show', compact('user', 'orders'));
    }
}