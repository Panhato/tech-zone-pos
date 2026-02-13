<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        // allow only admin or super_admin to access these actions
        $this->middleware(function ($request, $next) {
            if (! Auth::check() || ! in_array(Auth::user()->role, ['super_admin', 'admin'])) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        });
    }

    // List orders
    public function index()
    {
        $orders = Order::with('items')->latest()->paginate(20);
        return view('admin.orders.index', compact('orders'));
    }

    // Show single order
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Update status / respond
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $data = $request->validate([
            'status' => 'required|string|in:pending,processing,completed,cancelled',
            'note' => 'nullable|string'
        ]);

        $order->status = $data['status'];
        $order->save();

        return back()->with('success', 'Order status updated');
    }
}
