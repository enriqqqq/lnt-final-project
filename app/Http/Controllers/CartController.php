<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;

class CartController extends Controller
{
    // Add to Cart
    public function addToCart(Request $request, User $user, Item $item){
        $formFields = $request->validate([
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'item_id' => ['required', 'integer', Rule::exists('items', 'id')],
            'amount' => ['required', 'integer', 'gt:0'],
        ]);

        $cart = Cart::where('user_id', $user->id)->where('item_id', $item->id)->first();

        // If item already in cart, just add amount
        if($cart){
            $cart->amount += $formFields['amount'];
            
            // Check if stock is enough
            if($cart->amount > $item->stock){
                return redirect('/')->with('message', 'Sorry! We don\'t we have enough stock');
            }
            $cart->save();
        }
        else {
            // Check if stock is enough
            if($formFields['amount'] > $item->stock){
                return redirect('/')->with('message', 'Sorry! We don\'t we have enough stock');
            }

            Cart::create($formFields);
        }
        
        // Update stock only after checkout
        return redirect('/')->with('message', 'Item added to cart.');
    }

    // Update Cart
    public function update(Request $request, Cart $cart){
        $formFields = $request->validate([
            'amount' => ['required', 'integer', 'gt:0'],
        ]);

        $cart = Cart::where('id', $cart->id)->with('item')->first();

        // Check if stock is enough
        if($formFields['amount'] + $cart->amount > $cart->item->stock){
            return redirect('/')->with('message', 'Sorry! We don\'t we have enough stock');
        }

        $cart->update($formFields);
        return redirect('/')->with('message', 'Cart Updated.');
    }

    // Delete Cart
    public function destroy(Cart $cart){
        $cart->delete();
        return redirect('/')->with('message', 'You\' removed item from the cart.');
    }

    // Show Checkout Page
    public function checkout(){
        $cartItems = Cart::where('user_id', auth()->user()->id)->with('item')->get();
        
        // show intial total
        $total = 0;
        foreach($cartItems as $cartItem){
            $total += $cartItem->amount * $cartItem->item->price;
        }

        return view('checkout', [
            'items' => Item::with('category')->get(),
            'cartItems' => $cartItems,
            'total' => $total
        ]);
    }
    
    // Store Order
    public function store(Request $request, User $user){
        $allowedFields = [
            'address',
            'postal_code',
            'amounts',
            'total',
            '_token'
        ];

        // get amount input array
        $amounts = $request->input('amounts');
        if($amounts == null){
            return redirect()->back()->with('message', 'An error occured.');
        }
        // validate amount
        $formFields = $request->validate([
            'amounts.*' => ['required', 'numeric', 'min:1']
        ]);

        // save any updated amount
        foreach($amounts as $cartId => $amount){
            $cartItem = Cart::find($cartId);

            if(!$cartItem){
                return redirect('/')->with('message', 'An error occured.');
            }
            
            $cartItem->amount = $amount;
            $cartItem->save();
        }

        // reject if there is any other field
        $extraFields = array_diff(array_keys($request->all()), $allowedFields);
        if(!empty($extraFields)){
            return redirect()->back()->with('message', 'An error occured.');
        }

        $formFields = $request->validate([
            'address' => ['required'],
            'postal_code' => ['required', 'regex:/^[0-9]{5}$/'],
            'total' => ['integer', 'required', 'min:1']
        ]);
        
        foreach($amounts as $cartId => $amount){
            $cartItem = Cart::find($cartId);

            if(!$cartItem){
                return redirect('/')->with('message', 'An error occured.');
            }
            else if($amount > $cartItem->item->stock){
                return redirect('/')->with('message', 'Sorry! We don\'t have enough stock');
            }
            else {
                $date = date('Ymd');
                $time = date('His');

                $formFields['invoice'] = 'INV-' . $date . '-' . $user->id . '-' . $time;
                $formFields['user_id'] = $user->id;
                $formFields['item_id'] = $cartItem->item->id;
                $formFields['amount'] = $amount;
                
                // reduce stock
                $cartItem->item->stock -= $amount;
                $cartItem->item->save();
                Order::create($formFields);

                // delete cart items
                $cartItem->delete();
            }
        }

        // no error, show invoice page with print (send mail) button
        return redirect('/invoice' . '/' . $user->id . '/' . $formFields['invoice'])->with('message', 'Your order is successful.');
    }
}