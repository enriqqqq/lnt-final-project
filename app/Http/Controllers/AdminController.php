<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Category;

class AdminController extends Controller
{
    // Show Dashboard
    public function index(){
        return view('admin.index', [
            'items' => Item::with('category')->latest()->filter(request(['search','category']))->get(),
            'categories' => Category::all()
        ]);
    }
}
