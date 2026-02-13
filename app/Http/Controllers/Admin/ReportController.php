<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf; // ត្រូវប្រាកដថាបានបន្ថែមបន្ទាត់នេះ

class ReportController extends Controller
{
    /**
     * របាយការណ៍ស្តុកទំនិញបច្ចុប្បន្ន
     */
    public function stockReport()
    {
        $products = Product::with(['category'])->withCount(['transactions as stock_in' => function($query) {
            $query->where('type', 'in');
        }])->withCount(['transactions as stock_out' => function($query) {
            $query->where('type', 'out');
        }])->latest()->get();

        return view('admin.reports.stock', compact('products'));
    }

    /**
     * របាយការណ៍ប្រតិបត្តិការ (Transactions)
     */
    public function transactionReport()
    {
        $transactions = StockTransaction::with(['product', 'user'])->latest()->paginate(20);
        return view('admin.reports.transactions', compact('transactions'));
    }

    /**
     * របាយការណ៍លក់ (Sale Report)
     */
    public function saleReport(Request $request)
    {
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        $query = Order::with(['user'])
                    ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate]);

        $orders = $query->latest()->get();
        $totalSales = $orders->sum('total_amount');
        $totalOrders = $orders->count();

        return view('admin.reports.sales', compact(
            'orders', 
            'totalSales', 
            'totalOrders', 
            'startDate', 
            'endDate'
        ));
    }

    /**
     * បំប្លែងរបាយការណ៍លក់ទៅជាឯកសារ PDF (បន្ថែមថ្មី)
     */
    public function exportSalePdf(Request $request)
    {
        // ១. ចាប់យកកាលបរិច្ឆេទពី URL (ដើម្បីឱ្យ PDF ត្រូវជាមួយអ្វីដែលអ្នក Filter លើ Web)
        $startDate = $request->input('start_date', date('Y-m-d'));
        $endDate = $request->input('end_date', date('Y-m-d'));

        // ២. ទាញទិន្នន័យតាមចន្លោះថ្ងៃ
        $orders = Order::with(['user'])
                    ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
                    ->latest()
                    ->get();

        $totalSales = $orders->sum('total_amount');

        // ៣. រៀបចំទិន្នន័យផ្ញើទៅកាន់ View PDF
        $data = [
            'orders' => $orders,
            'totalSales' => $totalSales,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'reportDate' => date('d-m-Y H:i A')
        ];

        // ៤. បង្កើត PDF ពី View (យើងនឹងបង្កើត View នេះនៅជំហានបន្ទាប់)
        $pdf = Pdf::loadView('admin.reports.pdf_sales', $data);

        // ៥. ទាញយកឯកសារ (Download)
        return $pdf->download('Sale-Report-'.$startDate.'-to-'.$endDate.'.pdf');
    }
}