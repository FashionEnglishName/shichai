<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Article $article){
        $categories = Category::all();
        return view('articles.create_and_edit', compact('article', 'categories'));
    }

    public function edit(Article $article){
        $categories = Category::all();
        return view('articles.create_and_edit', compact('article', 'categories'));
    }
}
