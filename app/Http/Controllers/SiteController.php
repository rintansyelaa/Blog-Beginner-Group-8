<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;

class SiteController extends Controller
{
    public function overview()
    {
        $stats = [
            [
                'label' => 'Total Articles',
                'total' => Article::count(),
            ],
            [
                'label' => 'Total Tags',
                'total' => Tag::count(),
            ],
            [
                'label' => 'Total Categories',
                'total' => Category::count(),
            ],
        ];

        return view('dashboard', compact('stats'));
    }

    public function homepage(Request $request)
    {
        $articleList = Article::with(['tags', 'user', 'category'])
            ->latest()
            ->filter($request->all())
            ->paginate(6);
        $tagList = Tag::all();
        $categoryList = Category::all();

        return view('welcome', compact('articleList', 'tagList', 'categoryList'));
    }

    public function aboutUs()
    {
        return view('about');
    }
}
