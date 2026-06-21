<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function view(Order $order)
    {
        if ($order->user_id && $order->user_id !== auth()->id() && !auth()->user()?->is_admin) {
            abort(404);
        }

        $order->load('items');
        $storeName = Setting::getValue('store_name', 'Warung Aku');
        $storeAddress = Setting::getValue('address', '');
        $storeWa = Setting::getValue('wa_number', '');

        return view('invoice.show', compact('order', 'storeName', 'storeAddress', 'storeWa'));
    }

    public function pdf(Order $order)
    {
        if ($order->user_id && $order->user_id !== auth()->id() && !auth()->user()?->is_admin) {
            abort(404);
        }

        $order->load('items');
        $storeName = Setting::getValue('store_name', 'Warung Aku');
        $storeAddress = Setting::getValue('address', '');
        $storeWa = Setting::getValue('wa_number', '');

        $pdf = Pdf::loadView('invoice.pdf', compact('order', 'storeName', 'storeAddress', 'storeWa'));
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}
