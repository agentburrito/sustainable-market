<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index() 
    {
        $categories = Category::where('parent_id', null)->withCount('listings')->get();
        return view('welcome', compact('categories'));
    }
}
