<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;
use App\Models\Cart;

class ItemController extends Controller
{
    // Get all entries
    public function index(CartController $cartController){
        $data = [
            'items' => Item::with('category')->latest()->filter(request(['search','category']))->get(),
            'categories' => Category::all(),
        ];

        if(auth()->check()){
            $data['cart'] = Cart::where('user_id', auth()->user()->id)->with('item')->get();
        }

        return view('index', $data);
    }

    // Get all entries for admin
    public function admin_index(){
        return view('admin.index', [
            'items' => Item::with('category')->latest()->filter(request(['search','category']))->get(),
            'categories' => Category::all()
        ]);
    }

    // Update entry
    public function update(Request $request, Item $item){
        $formFields = $request->validate([
            'category_id' => ['integer', Rule::exists('categories', 'id')],
            'name' => ['between:5, 80'],
            'price' => ['integer'],
            'stock' => ['integer']
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images/items', $imageName);
            $formFields['image'] = $imageName;
        }

        $item->update($formFields);
        return redirect('/admin')->with('message', 'Item sucessfully updated.');
    }

    // Delete entry
    public function destroy(Item $item){
        Storage::delete('public/images/items/' . $item->image);
        $item->delete();
        return redirect('/admin')->with('message', 'Entry sucessfully deleted.');
    }

    // Show create form
    public function create(){
        return view('create', [
            'categories' => Category::all()
        ]);
    }

    // Store entry
    public function store(Request $request){
        $formFields = $request->validate([
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')],
            'name' => ['required', 'between:5, 80'],
            'price' => ['required', 'integer'],
            'stock' => ['required', 'integer']
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/images/items', $imageName);
            $formFields['image'] = $imageName;
        }

        Item::create($formFields);
        return redirect('/admin')->with('message', 'Item sucessfully updated.');
    }
}