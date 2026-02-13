<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase History - Tech Zone</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;600;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style> body { font-family: 'Poppins', 'Kantumruy Pro', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-gray-800">

    @include('partials.navbar')

    <div class="container mx-auto px-6 pt-32 pb-10">
        <h1 class="text-3xl font-bold text-slate-800 mb-8"><i class="fas fa-history text-blue-600"></i> ប្រវត្តិការបញ្ជាទិញ</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 relative" role="alert">
                <strong class="font-bold">ជោគជ័យ!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="space-y-6">
            @foreach($orders as $order)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex flex-wrap justify-between items-center">
                        <div class="flex gap-6 text-sm">
                            <div>
                                <p class="text-gray-500 mb-1">លេខវិក្កយបត្រ</p>
                                <p class="font-bold text-slate-900">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 mb-1">កាលបរិច្ឆេទ</p>
                                <p class="font-medium">{{ $order->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 mb-1">អតិថិជន</p>
                                <p class="font-medium">{{ $order->customer_name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 mt-4 md:mt-0">
                            <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-bold uppercase tracking-wide">
                                {{ $order->status }}
                            </span>
                            <span class="text-xl font-bold text-blue-600">${{ number_format($order->total_price, 2) }}</span>
                        </div>
                    </div>

                    <div class="p-6">
                        @foreach($order->items as $item)
                            <div class="flex justify-between items-center py-3 border-b border-gray-100 last:border-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-100 rounded flex items-center justify-center text-gray-400">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $item->product_name }}</p>
                                        <p class="text-sm text-gray-500">x {{ $item->quantity }}</p>
                                    </div>
                                </div>
                                <div class="font-medium text-gray-700">
                                    ${{ number_format($item->price, 2) }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if($orders->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500">មិនទាន់មានប្រវត្តិការទិញនៅឡើយទេ។</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>