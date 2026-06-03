<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('items');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->latest()->paginate(15)->withQueryString();
        $totalRevenue = Order::sum('total_price');

        $topProducts = \DB::table('order_items')
            ->select('product_name', \DB::raw('SUM(quantity) as total_qty'))
            ->groupBy('product_name')
            ->orderByDesc('total_qty')
            ->take(10)
            ->get();

        return view('admin.orders.index', compact('orders', 'totalRevenue', 'topProducts'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processed,completed,cancelled',
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function exportCsv(Request $request)
    {
        $query = Order::with('items');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $orders = $query->latest()->get();

        $filename = 'laporan-pesanan-' . now()->format('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($orders) {
            $output = fopen('php://output', 'w');

            fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

            fputcsv($output, [
                'No. Pesanan', 'Pelanggan', 'Telepon', 'Total Item',
                'Total Harga', 'Status', 'Tanggal', 'Item'
            ]);

            foreach ($orders as $order) {
                $itemsList = $order->items->map(fn($i) =>
                    $i->product_name . ' (' . $i->quantity . 'x Rp' . number_format($i->product_price, 0, ',', '.') . ')'
                )->implode('; ');

                fputcsv($output, [
                    '#' . $order->id,
                    $order->customer_name,
                    $order->customer_phone,
                    $order->total_items,
                    $order->total_price,
                    ucfirst($order->status),
                    $order->created_at->format('d/m/Y H:i'),
                    $itemsList,
                ]);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
