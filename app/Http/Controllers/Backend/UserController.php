<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;


class UserController extends Controller
{
    public function index()
    {
        $perpage = 10;
        $page = request()->get('page', 1);
        $offset = ($page - 1) * $perpage;

        $loggedInUserId = Auth::id();
        // users excluding the logged-in user
        $users = User::where('id', '!=', $loggedInUserId)->orderBy('created_at', 'desc')->paginate($perpage);

        return view("backend.user.index", compact("users"));
    }

    public function create()
    {
        $roles=Role::pluck("name","id")->all();
        return view("backend.user.create",compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required|confirmed',
            'roles_id' => 'required',
            'image' => 'nullable|image|max:2048',

        ],[
            'roles_id.required' => 'Role is required',
            'image.uploaded' => 'Image more than 2MB is not supported',


        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user'), $imageName);
            $data['image'] = $imageName;
        };

        $user = User::create($data);
        $user->password = Hash::make($request->password);
        $user->published = $request->has('published') ? 1 : 0;
        $user->roles()->attach($request->roles_id);

        $user->save();

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }


    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','id')->all();
        return view('backend.user.edit', compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'nullable|confirmed',
            'roles_id'=>'required',
            'image' => 'nullable|image|max:2048',

        ],[
            'roles_id.required' => 'Role is required',
            'image.uploaded' => 'Image more than 2MB is not supported',


        ]);

        $user = User::find($id);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/user'), $imageName);

            // Delete the old image if exists
            if ($user->image) {
                Storage::delete('public/images/user/' . $user->image);
            }

            $user->image = $imageName;
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($request->filled('password')) {
        $user->password = bcrypt($request->input('password'));
        }
        $user->published = $request->has('published') ? 1 : 0;
        $user->roles()->sync($request->roles_id);
        $user->save();


        return redirect()->route('user.index')->with('success', 'User Edited Successfully');
    }

    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        $user->roles()->detach($request->roles_id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    }

    public function togglePublished($id)
    {
        $user = User::find($id);
        $user->published = !$user->published;
        $user->save();

        return response()->json(['status' => 'success', 'user' => $user]);
    }


}
