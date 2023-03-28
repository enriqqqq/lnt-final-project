<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class ItemController extends Controller
{
    // Get all entries
    public function index(){
        return view('index', [
            'items' => Item::with('category')->latest()->filter(request(['search','category']))->get(),
            'categories' => Category::all()
        ]);
    }
}
