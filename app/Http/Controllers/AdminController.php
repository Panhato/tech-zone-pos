<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // ១. ទាញទិន្នន័យលក់ក្នុងរយៈពេល ៧ ថ្ងៃចុងក្រោយសម្រាប់ Line Chart
        $salesData = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_amount) as total')
        )
        ->where('created_at', '>=', now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // ២. ទាញទិន្នន័យប្រភេទផលិតផលសម្រាប់ Pie Chart
        $categoryData = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->select('categories.name', DB::raw('count(*) as count'))
            ->groupBy('categories.name')
            ->get();

        // ៣. ទាញយកទំនិញដែលជិតអស់ស្តុក (ឧទាហរណ៍៖ ក្រោម ឬស្មើ ៥)
        $lowStockProducts = Product::where('qty', '<=', 5)
                                    ->where('qty', '>', 0)
                                    ->get();

        // ៤. ទាញយកទំនិញដែលដាច់ស្តុក (Qty = 0)
        $outOfStockProducts = Product::where('qty', '<=', 0)
                                      ->get();

        return view('admin.dashboard', [
            // ទិន្នន័យសម្រាប់ Charts
            'salesLabels'        => $salesSalesData->pluck('date'),
            'salesValues'        => $salesSalesData->pluck('total'),
            'catLabels'          => $categoryData->pluck('name'),
            'catValues'          => $categoryData->pluck('count'),
            
            // ទិន្នន័យសរុប (Summary Stats)
            'totalProducts'      => Product::count(),
            'totalOrders'        => Order::count(),
            'totalRevenue'       => Order::sum('total_amount'),

            // ទិន្នន័យសម្រាប់ Alerts
            'lowStockProducts'   => $lowStockProducts,
            'outOfStockProducts' => $outOfStockProducts,
        ]);
    }
}