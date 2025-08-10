<?php

namespace App\Http\Controllers\Admin;
use App\Models\Tag;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
class TagController extends Controller
{
    // Display a listing of the tags
    public function index()
    {
        // Fetch all tags from the database
        $tags = Tag::orderBy('created_at', 'desc')->get();
        // Return the view with the tags data
        return view('admin.tags.index', compact('tags'));
    }

    //create 
    public function create(Request $request)
    {
        // Validate the request data
        return view('admin.tags.create');
    }

    public function store(Request $request)
    {
        
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name'
        ]);

        // Create a new tag
        $tag = new Tag();
        $tag->name = $request->input('name');
        //generate a slug from the name 
        
        $tag->slug = Str::slug($request->input('name')); // Generate a slug from the name
        $tag->save();

        // Redirect or return a response
        return redirect()->route('admin.tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        // Return the view with the tag data
        return view('admin.tags.edit', compact('tag'));
    }
    public function update(Request $request, Tag $tag)
    {
       
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name,' . $tag->id
        ]);

        // Update the tag
        $tag->name = $request->input('name');
        $tag->slug = Str::slug($request->input('name')); // Generate a slug from the name
        $tag->save();

        // Redirect or return a response
        return redirect()->route('admin.tags.index')->with('success', 'Tag updated successfully.');
    }
    public function destroy(Tag $tag)
    {
        // Delete the tag
        $tag->delete();

        // Redirect or return a response
        return redirect()->route('admin.tags.index')->with('success', 'Tag deleted successfully.');
    }
    public function show(Tag $tag)
    {
        // Return the view with the tag data
        return view('admin.tags.show', compact('tag'));
    }
    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'required|string|max:255'
        ]);

        // Search for tags based on the query
        $tags = Tag::where('name', 'LIKE', '%' . $request->input('query') . '%')->get();

        // Return the view with the search results
        return view('admin.tags.index', compact('tags'));
    }

}
