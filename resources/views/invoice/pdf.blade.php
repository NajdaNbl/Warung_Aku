<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }} - {{ $storeName }}</title>
    <style>
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #1B4332; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { color: #1B4332; margin: 0; font-size: 22px; }
        .header p { color: #666; margin: 3px 0; font-size: 11px; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .info td { vertical-align: top; }
        .customer-box { background: #FAF5EB; padding: 10px 15px; border-radius: 8px; margin-bottom: 20px; font-size: 11px; }
        .customer-box p { margin: 2px 0; }
        .customer-box .label { color: #999; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.items th { background: #1B4332; color: white; padding: 8px 10px; text-align: left; font-size: 10px; }
        table.items th.right { text-align: right; }
        table.items th.center { text-align: center; }
        table.items td { padding: 8px 10px; border-bottom: 1px solid #eee; font-size: 11px; }
        table.items td.right { text-align: right; }
        table.items td.center { text-align: center; }
        .total { text-align: right; border-top: 2px solid #1B4332; padding-top: 10px; margin-bottom: 30px; }
        .total .row { margin: 3px 0; }
        .total .grand { font-size: 16px; font-weight: bold; color: #D4A373; }
        .footer { text-align: center; color: #999; font-size: 10px; border-top: 1px solid #eee; padding-top: 15px; }
        .notes { margin-bottom: 20px; }
        .notes h4 { margin: 0 0 5px; color: #1B4332; font-size: 11px; }
        .notes p { margin: 0; font-size: 11px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $storeName }}</h1>
        @if($storeAddress)<p>{{ $storeAddress }}</p>@endif
        @if($storeWa)<p>WA: {{ $storeWa }}</p>@endif
    </div>

    <div class="info">
        <table>
            <tr>
                <td>
                    <p><strong>Invoice:</strong> #{{ $order->id }}</p>
                </td>
                <td style="text-align: right;">
                    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="customer-box">
        <p><span class="label">Kepada Yth.</span></p>
        <p><strong>{{ $order->customer_name }}</strong></p>
        @if($order->customer_phone)<p>{{ $order->customer_phone }}</p>@endif
        @if($order->customer_address)<p>{{ $order->customer_address }}</p>@endif
    </div>

    <table class="items">
        <thead>
            <tr>
                <th>Produk</th>
                <th class="center">Qty</th>
                <th class="right">Harga</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td class="center">{{ $item->quantity }}</td>
                <td class="right">{{ 'Rp' . number_format($item->product_price, 0, ',', '.') }}</td>
                <td class="right">{{ 'Rp' . number_format($item->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <div class="row">Total Item: <strong>{{ $order->total_items }}</strong></div>
        <div class="row grand">Total: {{ $order->total_price_formatted }}</div>
    </div>

    @if($order->notes)
    <div class="notes">
        <h4>Catatan:</h4>
        <p>{{ $order->notes }}</p>
    </div>
    @endif

    <div class="footer">
        Terima kasih telah berbelanja di {{ $storeName }}
    </div>
</body>
</html>
