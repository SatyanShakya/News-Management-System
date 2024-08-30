<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permision;
use Illuminate\Support\Facades\Gate;


class PermissionController extends Controller
{

    public function index(){
        Gate::authorize("permission-view");

        $permissions = Permision::all();
        return view("backend.permission.index",compact("permissions"));
    }
}
