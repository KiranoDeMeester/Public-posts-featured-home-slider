<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        return 'Hier komt later de categoriepagina voor: ' . $category->name . ' (Opdracht 8)';
    }
}
