<?php

namespace App\Http\Controllers\Backend;

use App\Models\Role;
use App\Models\Permision;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;


class RoleController extends Controller
{
    public function index()
    {
        Gate::authorize('role-view');
        $perpage=10;
        $roles = Role::with('permissions')->orderBy('created_at', 'DESC')->paginate($perpage);
        return view("backend.role.index", compact("roles"));
    }

    public function create()
    {
        Gate::authorize("role-create");
        $permissions = Permision::pluck("name","id");
        return view("backend.role.create",compact("permissions"));
    }

    public function store(Request $request)
    {
        Gate::authorize("role-create");
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:roles,slug|regex:/^[a-zA-Z0-9\-]+$/',
        ]);
        $slug = Str::slug(str_replace('@', '', $request->slug));
        if (Role::where('slug', $slug)->exists()) {
            return redirect()->back()->withInput()->withErrors(['slug' => 'The slug is not unique.']);
        }


        $role = Role::create($request->all());
        $role->slug = $slug;
        $role->Permissions()->attach($request->permissions_id);
        $role->save();

        return redirect()->route('role.index')->with("success", "Roles Created Successfully");
    }

    public function edit($id)
    {
        Gate::authorize("role-edit");
        $role = Role::find($id);
        $permissions = Permision::pluck("name","id");
        return view("backend.role.edit", compact("role","permissions"));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize("role-edit");
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|unique:roles,slug'. $id . '|regex:/^[a-zA-Z0-9\-]+$/',
        ]);
        $slug = Str::slug(str_replace('@', '', $request->slug));


        $role = Role::find($id);
        $role->name = $request->name;
        $role->slug = $slug;
        $role->Permissions()->sync($request->permissions_id);
        $role->save();

        return redirect()->route('role.index')->with('success','Role Updated Successfully');
    }

    public function destroy($id, request $request){

        Gate::authorize('role-delete');
        $role = Role::find($id);

        if ($role->users()->count() > 0) {
            return redirect()->route('role.index')->with('error', 'Role cannot be deleted because it is linked to Users.');
        }

        $role->permissions()->detach($request->permission_id);
        $role->delete();
        return redirect()->route('role.index')->with('success','Role Deleted Successfully');
    }
}
