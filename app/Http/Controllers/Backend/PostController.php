<?php

namespace App\Http\Controllers\Backend;

use App\Models\post;
use App\Models\Author;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        Gate::authorize('post-view');

        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;

        $posts = post::orderBy('created_at', 'DESC')->offset($offset)->paginate($perPage);

        return view('backend.post.index', compact('posts'));
    }

    public function create()
    {
        Gate::authorize('post-create');

        // $categories = Category::where('published', '1')->pluck('name', 'id');
        $authors = Author::where('published', '1')->pluck('name', 'id');
        $categories=category::where('published','1')->pluck('name','id');
        return view('backend.post.create', compact('authors','categories'));
    }

    public function store(Request $request)
    {
        Gate::authorize('post-create');

        $request->validate([
            'title' => 'required|string',
            'authors_id' => 'required',
            'categories_id'=> 'required',
            'image' => 'nullable|image|max:2048',

        ],[
            'authors_id.required' => 'Author is required',
            'categories_id.required'=>'Category is required',
            'image.uploaded' => 'Image more than 2MB is not supported',
        ]);

        $postData = $request->all();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/posts'), $imageName);
            $postData['image'] = $imageName;
        }

        $post = post::create($postData);
        $post->published = $request->has('published') ? 1 : 0;
        $post->authors()->attach($request->authors_id);
        $post->categories()->attach($request->categories_id);

        $post->save();


        if ($post) {
            return redirect()->route('post.index')->with('success', 'Post Created Successfully');
        } else {
            return redirect()->route('post.index')->with('error', 'Post Creation Failed');
        }

    }

    public function edit($id)
    {
        Gate::authorize('post-edit');

        $post = post::findOrFail($id);
        $authors = Author::where('published', '1')->pluck('name', 'id');
        $categories = category::where('published', '1')->pluck('name', 'id');
        return view('backend.post.edit', compact('post','authors','categories'));
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('post-edit');

        $request->validate([
            'title' => 'required',
            'authors_id'=>'required',
            'categories_id'=> 'required',
            'image' => 'nullable|image|max:2048',

        ],[
            'authors_id.required' => 'Please select atleast one author.',
            'categories_id.required'=>'Please select atleast one category',
            'image.uploaded' => 'Image more than 2MB is not supported',

        ]);

        $post = post::findOrFail($id);

        // Image upload
        if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/posts'), $imageName);

            // Delete the old image if exists
            if ($post->image) {
                Storage::delete('public/images/posts/' . $post->image);
            }

            $post->image = $imageName;
        }

        $post->title = $request->title;
        $post->content = $request->content;
        $post->summary = $request->summary;
        $post->published = $request->has('published') ? 1 : 0;

        $post->authors()->sync($request->authors_id);
        $post->categories()->sync($request->categories_id);
        $post->save();


        return redirect()->route('post.index')->with('success', 'Post updated successfully');
    }

    public function destroy($id, Request $request)
    {
        Gate::authorize('post-delete');

        $post = post::findOrFail($id);

        $post->authors()->detach($request->authors_id);
        $post->categories()->detach($request->categories_id);
        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted successfully');
    }

    public function togglePublished($id)
    {
        Gate::authorize('post-edit');

        $post = post::find($id);
        $post->published = !$post->published;
        $post->save();

        return response()->json(['status' => 'success', 'post' => $post]);
    }


}
