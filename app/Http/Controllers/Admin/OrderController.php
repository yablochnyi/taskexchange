<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Order\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
//        $orders = Order::all();
//        foreach ($orders as $order)
//        {
//            dd($order->offer->performer->username);
//        }
//        dd($orders);
//        $orders->offer->performer_id;
//        dd($orders);
        $orders = OrderResource::collection(Order::all());
        return Inertia::render('Admin/Orders', compact('orders'));
    }
}
