<?php

namespace App\Http\Controllers\Backend;

use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\post;
use Illuminate\Support\Facades\Gate;

class AuthorController extends Controller
{
    public function index(){
        Gate::authorize("author-view");
        $perPage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perPage;

        $authors = Author::orderBy('created_at', 'DESC')->offset($offset)->paginate($perPage);

        return view('backend.author.index', compact('authors'));
    }

    public function create(){
        Gate::authorize('author-create');
        return view("backend.author.create");
    }

    public function store(Request $request){
        Gate::authorize("author-create");

        $request->validate([
            'name'=>'required|string',
            'image' => 'nullable|image|max:2048',

       ],[
        'image.uploaded' => 'Image more than 2MB is not supported',

    ] );

       $data = $request->all();
       if ($request->hasFile('image'))
       {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images/author'), $imageName);
        $data['image'] = $imageName;
       }

       $author = Author::create($data);
       $author->published = $request->has('published') ? 1 : 0;
       $author->save();
        return redirect()->route('author.index')->with("success","Author created Successfully");
    }

    public function show($id){
    }

    public function edit($id){
        Gate::authorize("author-edit");

        $author = Author::find($id);
        return view("backend.author.edit", compact("author"));
    }

    public function update(Request $request, $id){
        Gate::authorize("author-edit");
        $request->validate([
            "name"=> "required|String",
            'image' => 'nullable|image|max:2048',

        ] ,[
            'image.uploaded' => 'Image more than 2MB is not supported',

        ]);


        $author = author::find( $id );

         if ($request->hasFile('image'))
        {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/author'), $imageName);

            // Delete the old image if exists
            if ($author->image) {
                Storage::delete('public/images/author/' . $author->image);
            }

            $author->image = $imageName;
        }

        // Update other fields
        $author->name = $request->name;
        $author->description = $request->description;
        $author->published = $request->has('published') ? 1 : 0;
        $author->save();

        return redirect()->route('author.index')->with("success","Author updated Successfully");
    }


    public function togglePublished($id)
    {
        Gate::authorize("author-edit");
        $author = Author::find($id);
        $author->published = !$author->published;
        $author->save();

        return response()->json(['status' => 'success', 'author' => $author]);
    }

    public function destroy($id){
        Gate::authorize('author-delete');
        $author = Author::find($id);

        if ($author->posts()->count() > 0) {
            return redirect()->route('author.index')->with('error', 'Author cannot be deleted because it is linked to posts.');
        }

        $author->delete();

        return redirect()->route('author.index')->with('success','Deleted successfully');
    }



}
