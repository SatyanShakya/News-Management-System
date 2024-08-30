<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\category;
use App\Models\post;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        Gate::authorize('category-view');
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;

        $categories = Category::orderBy('created_at', 'desc')->paginate($perPage);

        return view("backend.category.index", compact("categories"));
    }

    public function create()
    {
        Gate::authorize("category-create");
        return view("backend.category.create");
    }

    public function store(Request $request)
    {
        Gate::authorize("category-create");
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:categories,slug|regex:/^[a-zA-Z0-9\-]+$/',
            'description' => 'nullable|string'
        ]);

        // Remove "@" symbol
        $slug = Str::slug(str_replace('@', '', $request->slug));

        if (Category::where('slug', $slug)->exists()) {
            return redirect()->back()->withInput()->withErrors(['slug' => 'The slug is not unique.']);
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'published' => $request->has('published') ? 1 : 0
        ]);

        return redirect()->route('category.index')->with("success", "Category Created Successfully");
    }

  
    public function edit($id)
    {

        Gate::authorize("category-edit");
        $category = Category::find($id);
        return view("backend/category/edit", compact("category"));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize("category-edit");
        $request->validate([
            "name" => 'required',
            'slug' => 'required|unique:categories,slug' . $id . '|regex:/^[a-zA-Z0-9\-]+$/',
        ]);

        // Remove "@" symbol
        $slug = Str::slug(str_replace('@', '', $request->slug));

        if (Category::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            return redirect()->back()->withInput()->withErrors(['slug' => 'The slug is not unique.']);
        }

        $category = category::find($id);

        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'published' => $request->has('published') ? 1 : 0
        ]);

        return redirect()->route('category.index')->with('success', 'Category Updated Successfuly');
    }

    public function destroy($id)
    {
        Gate::authorize('category-delete');
        $category = Category::find($id);

        if ($category->posts()->count() > 0) {
            return redirect()->route('category.index')->with('error', 'Category cannot be deleted because it is linked to posts.');
        }

        $category->delete();
        return redirect()->route('category.index')->with("success", "Category Deleted Successfully");
    }

    public function togglePublished($id)
    {
        Gate::authorize("category-edit");
        $category = Category::find($id);
        $category->published = !$category->published;
        $category->save();

        return response()->json(['status' => 'success', 'category' => $category]);
    }
}
