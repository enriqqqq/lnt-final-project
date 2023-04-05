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
        if (auth()->user()->id != $user->id && !auth()->user()->isAdmin()) {
            return redirect('/')->with('message', "An error occured.");
        }

        return view('invoices', [
            'orders' => Order::select('invoice', 'total', 'created_at')
                            ->distinct()
                            ->where('user_id', $user->id)
                            ->get()
        ]);
    }

    public function show(User $user, Order $order){
        if (auth()->user()->id != $user->id && !auth()->user()->isAdmin()) {
            return redirect('/')->with('message', "An error occured.");
        }
        return view('invoice', [
            'items' => Order::where('user_id', $user->id)->where('invoice', $order->invoice)->get(),
            'invoice' => $order->invoice,
            'total' => $order->total,
            'address' => $order->address,
            'postal_code' => $order->postal_code,
            'date' => $order->created_at->format('j F Y')
        ]);
    }

    public function all(){
        return view('admin.invoices', [
            'orders' => Order::select('user_id', 'invoice', 'total', 'created_at')
                            ->distinct()
                            ->get()
        ]);
    }

    public function sendMail(User $user, Order $order){
        Mail::to('youremail@example.com')->send(new PlacedOrder($order));

        return redirect('/')->with('message', 'An Email has been sent.');
    }
}