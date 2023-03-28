<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;
use App\Models\User;

class ItemController extends Controller
{
    // Get all entries
    public function index(){
        return view('index', [
            'items' => Item::with('category')->latest()->filter(request(['search','category']))->get(),
            'categories' => Category::all()
        ]);
    }

    public function admin_index(){
        return view('admin.index', [
            'items' => Item::with('category')->latest()->filter(request(['search','category']))->get(),
            'categories' => Category::all()
        ]);
    }
}
