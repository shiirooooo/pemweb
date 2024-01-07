<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    public function show(Order $order)
    {
        return view('orders.show', [
            'order' => $order,
        ]);
    }

    public function userOrders()
    {
        return view('orders.orders', [
            'orders' => Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function orders()
    {
        return view('orders.orders', [
            'orders' => Order::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        Alert::success('Berhasil', 'Pesanan berhasil dihapus');
        return redirect()->back();
    }
}
