<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function listCategories()
    {
        $categoryList = Category::paginate(10);

        return view('pages.categories.index', compact('categoryList'));
    }

    public function newCategoryForm()
    {
        return view('pages.categories.create');
    }

    public function saveCategory(Request $request)
    {
        $validatedInput = $request->validate($this->getValidationRules());

        Category::create($validatedInput);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function editCategory(Category $category)
    {
        return view('pages.categories.edit', compact('category'));
    }

    public function updateCategory(Request $request, Category $category)
    {
        $validatedInput = $request->validate($this->getValidationRules());

        $category->update($validatedInput);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function removeCategory(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    private function getValidationRules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
        ];
    }
}
