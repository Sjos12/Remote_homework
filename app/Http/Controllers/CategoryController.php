<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    // Create a new category.
    public function create(Request $request) {

        $category = new Category();
        $category->category = $request->category;
        $category->save();

        return redirect()->route('questions.create');
    }
}
