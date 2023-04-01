<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    // Store entry
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required']
        ]);

        Category::create($formFields);
        return redirect('/admin')->with('message', 'Category sucessfully created.');
    }

    // Update entry
    public function update(Request $request, Category $category){
        $formFields = $request->validate([
            'name' => ['string', 'required']
        ]);

        $category->update($formFields);
        return redirect('/admin')->with('message', 'Category sucessfully updated.');
    }

    // Delete entry
    public function destroy(Category $category){
        $category->delete();
        return redirect('/admin')->with('message', 'Category successfully deleted.');
    }
}