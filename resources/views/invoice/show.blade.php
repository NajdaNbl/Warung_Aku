<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->id }} - {{ $storeName }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
        }
        body { font-family: 'Inter', sans-serif; background: #FAF5EB; }
    </style>
</head>
<body class="py-12">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="text-center border-b border-gray-100 pb-6 mb-6">
                <h1 class="text-2xl font-bold text-[#1B4332]">{{ $storeName }}</h1>
                @if($storeAddress)<p class="text-sm text-gray-500 mt-1">{{ $storeAddress }}</p>@endif
                @if($storeWa)<p class="text-sm text-gray-500">WA: {{ $storeWa }}</p>@endif
            </div>

            <div class="flex items-center justify-between mb-6 text-sm">
                <div>
                    <p class="text-gray-400">Invoice</p>
                    <p class="font-semibold text-[#1B4332]">#{{ $order->id }}</p>
                </div>
                <div class="text-right">
                    <p class="text-gray-400">Tanggal</p>
                    <p class="font-semibold text-gray-700">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>

            <div class="bg-[#FAF5EB] rounded-xl p-4 mb-6 text-sm">
                <p class="text-gray-400 mb-1">Kepada Yth.</p>
                <p class="font-semibold text-gray-700">{{ $order->customer_name }}</p>
                @if($order->customer_phone)<p class="text-gray-500">{{ $order->customer_phone }}</p>@endif
                @if($order->customer_address)<p class="text-gray-500 mt-1">{{ $order->customer_address }}</p>@endif
            </div>

            <table class="w-full text-sm mb-6">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-3 text-gray-400 font-medium">Produk</th>
                        <th class="text-center py-3 text-gray-400 font-medium">Qty</th>
                        <th class="text-right py-3 text-gray-400 font-medium">Harga</th>
                        <th class="text-right py-3 text-gray-400 font-medium">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr class="border-b border-gray-50">
                        <td class="py-3 text-gray-700">{{ $item->product_name }}</td>
                        <td class="py-3 text-center text-gray-500">{{ $item->quantity }}</td>
                        <td class="py-3 text-right text-gray-500">{{ 'Rp' . number_format($item->product_price, 0, ',', '.') }}</td>
                        <td class="py-3 text-right font-medium text-[#1B4332]">{{ 'Rp' . number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="border-t border-gray-100 pt-4 space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Total Item</span>
                    <span class="font-semibold">{{ $order->total_items }}</span>
                </div>
                <div class="flex justify-between text-lg">
                    <span class="text-gray-700 font-semibold">Total Harga</span>
                    <span class="font-bold text-[#D4A373]">{{ $order->total_price_formatted }}</span>
                </div>
            </div>

            @if($order->notes)
            <div class="border-t border-gray-100 pt-4 mt-4">
                <p class="text-sm text-gray-400 mb-1">Catatan:</p>
                <p class="text-sm text-gray-600">{{ $order->notes }}</p>
            </div>
            @endif

            <div class="border-t border-gray-100 pt-6 mt-6 text-center text-xs text-gray-400">
                <p>Terima kasih telah berbelanja di {{ $storeName }}</p>
            </div>
        </div>

        <div class="flex justify-center space-x-4 mt-6 no-print">
            <button onclick="window.print()" class="px-6 py-3 bg-[#1B4332] text-white font-medium rounded-xl hover:bg-[#2D6A4F] transition-colors">
                Cetak Invoice
            </button>
            <a href="{{ route('invoice.pdf', $order) }}" class="px-6 py-3 bg-[#D4A373] text-white font-medium rounded-xl hover:opacity-90 transition-colors">
                Download PDF
            </a>
        </div>
    </div>
</body>
</html>
