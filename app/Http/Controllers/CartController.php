<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Item;
use App\Models\User;
use App\Models\Cart;

class CartController extends Controller
{
    // Add to Cart
    public function addToCart(Request $request, User $user, Item $item){
        $formFields = $request->validate([
            'user_id' => ['required', 'integer', Rule::exists('users', 'id')],
            'item_id' => ['required', 'integer', Rule::exists('items', 'id')],
            'amount' => ['required', 'integer'],
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
            'amount' => ['required', 'integer'],
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
}