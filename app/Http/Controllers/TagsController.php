<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function listTags()
    {
        $tagList = Tag::paginate(10);

        return view('pages.tags.index', compact('tagList'));
    }

    public function newTagForm()
    {
        return view('pages.tags.create');
    }

    public function saveTag(Request $request)
    {
        $validatedData = $request->validate($this->getValidationRules());

        Tag::create($validatedData);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function editTag(Tag $tag)
    {
        return view('pages.tags.edit', compact('tag'));
    }

    public function updateTag(Request $request, Tag $tag)
    {
        $validatedData = $request->validate($this->getValidationRules());

        $tag->update($validatedData);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function removeTag(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }

    private function getValidationRules()
    {
        return [
            'name' => 'required|string|min:3|max:255',
        ];
    }
}
