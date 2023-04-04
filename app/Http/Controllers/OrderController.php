<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(User $user){
        return view('invoices', [
            'orders' => Order::where('user_id', $user->id)->get(),
        ]);
    }

    public function show(User $user, Order $order){
        return view('invoice', [
            'items' => Order::where('user_id', $user->id)->where('invoice', $order->invoice)->get(),
            'invoice' => $order->invoice,
            'total' => $order->total,
            'address' => $order->address,
            'postal_code' => $order->postal_code,
            'date' => $order->created_at->format('j F Y')
        ]);
    }
}