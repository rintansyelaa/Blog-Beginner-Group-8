<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function listArticles()
    {
        $articles = Article::with(['category', 'tags', 'user'])->get();

        return view('pages.articles.index', compact('articles'));
    }

    public function newArticleForm()
    {
        $tagList = Tag::all();
        $categoryList = Category::all();

        return view('pages.articles.create', compact('categoryList', 'tagList'));
    }

    public function viewArticle(Article $article)
    {
        $article->load(['category', 'tags', 'user']);
        return view('pages.articles.detail', compact('article'));
    }

    public function saveArticle(Request $request)
    {
        $validatedData = $request->validate($this->getValidationRules());

        try {
            $associatedTags = collect($request->input('tags'))->map(function ($tagName) {
                return Tag::where('name', $tagName)->first();
            });

            $selectedCategory = Category::where('name', $request->input('category'))->first();

            if (!$selectedCategory) {
                return redirect()->route('articles.index')->with('error', 'Category does not exist');
            }

            $filePath = $this->uploadImage($request->file('image'));

            $validatedData['image'] = $filePath;
            $validatedData['user_id'] = auth()->id();
            $validatedData['category_id'] = $selectedCategory->id;

            DB::transaction(function () use ($validatedData, $associatedTags) {
                $newArticle = Article::create($validatedData);

                $associatedTags->each(function ($tag) use ($newArticle) {
                    if ($tag) {
                        $newArticle->tags()->attach($tag->id);
                    }
                });
            });

            return redirect()->route('articles.index')->with('success', 'Article created successfully');
        } catch (\Exception $exception) {
            error_log("[BLOG CONTROLLER] " . $exception->getMessage());
            DB::rollBack();
            return redirect()->route('articles.index')->with('error', 'Failed to create article');
        }
    }

    public function editArticle(Article $article)
    {
        $tagList = Tag::all();
        $categoryList = Category::all();

        return view('pages.articles.edit', compact('article', 'tagList', 'categoryList'));
    }

    public function updateArticle(Request $request, Article $article)
    {
        $validatedData = $request->validate($this->getEditValidationRules());

        try {
            if ($request->input('category') !== $article->category->name) {
                $newCategory = Category::where('name', $request->input('category'))->first();

                if (!$newCategory) {
                    return redirect()->route('articles.index')->with('error', 'Category does not exist');
                }

                $validatedData['category_id'] = $newCategory->id;
            }

            if ($request->hasFile('image')) {
                $validatedData['image'] = $this->uploadImage($request->file('image'), $article->image);
            }

            DB::transaction(function () use ($request, $article, $validatedData) {
                if ($request->filled('tags')) {
                    $article->tags()->detach();
                    $newTags = collect($request->input('tags'))->map(function ($tagName) {
                        return Tag::where('name', $tagName)->first();
                    });

                    $newTags->each(function ($tag) use ($article) {
                        if ($tag) {
                            $article->tags()->attach($tag->id);
                        }
                    });
                }

                $article->update($validatedData);
            });

            return redirect()->route('articles.index')->with('success', 'Article updated successfully');
        } catch (\Exception $exception) {
            error_log("[BLOG CONTROLLER] " . $exception->getMessage());
            DB::rollBack();
            return redirect()->route('articles.index')->with('error', 'Failed to update article');
        }
    }

    public function removeArticle(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Article deleted successfully');
    }

    public function detachTag(Article $article, Tag $tag)
    {
        $article->tags()->detach($tag->id);

        return redirect()->back();
    }

    private function uploadImage($image, $existingImage = null)
    {
        if ($existingImage && file_exists(public_path($existingImage))) {
            unlink(public_path($existingImage));
        }

        $fileName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $fileName);

        return 'images/' . $fileName;
    }

    private function getValidationRules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'full_text' => 'required|min:5|max:1000',
            'category' => 'required',
            'image' => 'required|file|mimes:jpg,png,jpeg',
        ];
    }

    private function getEditValidationRules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'full_text' => 'required|min:5|max:1000',
        ];
    }
}
