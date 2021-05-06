<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CategoryController extends Controller
{
    //
    public function create(Request $request) {
        $category = new Category();

        $category->fill([
            'category' => $request->category,
        ]);
        return;
    }
}
