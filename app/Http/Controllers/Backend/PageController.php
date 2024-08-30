<?php

namespace App\Http\Controllers\Backend;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;


class PageController extends Controller
{

    public function index()

    {
        gate::authorize('page-view');
        return view('backend.page.index');
    }

    public function fetchpage()
    {
        $pages = Page::orderBy('created_at', 'desc')->paginate(10);
        //  $pages = Page::orderBy('created_at', 'desc')->get();

        return response()->json([
            'pages' => $pages,
            'pagination' => (string) $pages->links()
        ]);
    }

    public function store(Request $request)
    {
        gate::authorize('page-create');
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'slug'    =>  'required|unique:page,slug|regex:/^[a-zA-Z0-9\-]+$/'
        ]);

        $slug = Str::slug(str_replace('@', '', $request->slug));

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->toArray()
            ]);
        }
        $pageData = $request->all();
        $pageData['published'] = $request->published == 1 ? 1 : 0;
        $pageData['slug'] = $slug;


        $record = Page::create($pageData);

        if ($record) {
            return response()->json([
                'status' => 200,
                'message' => 'Page Created successfully'
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'message' => 'Page Creation Failed'
            ]);
        }
    }

    public function edit($id)
    {
        Gate::authorize('page-edit');

        $page = Page::find($id);
        if($page)
        {
            return response()->json([
                'status'=>200,
                'page'=> $page,
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Page Found.'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('page-edit');

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'slug'    =>  'required|unique:page,slug'. $id . '|regex:/^[a-zA-Z0-9\-]+$/',
        ]);

        $slug = Str::slug(str_replace('@', '', $request->slug));

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors()->toArray()
            ]);
        }

            $page = Page::find($id);
            if($page)
            {
                $page->title = $request->input('title');
                $page->slug = $slug;
                $page->published = $request->published == 1 ? 1 : 0;
                $page->summary = $request->input('summary');
                $page->description= $request->input('description') ;
                $page->update();
                return response()->json([
                    'status'=>200,
                    'message'=>'Page Updated Successfully.'
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'No Page Found.'
                ]);
            }
    }


    public function destroy($id)
    {
        Gate::authorize('page-delete');

        $page = Page::find($id);
        if($page)
        {
            $page->delete();
            return response()->json([
                'status'=>200,
                'message'=>'Page Deleted Successfully.'
            ]);
        }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Page Found.'
            ]);
        }
    }

    public function togglePublished($id)
    {
        Gate::authorize('page-edit');

        $page = Page::find($id);
        $page->published = !$page->published;
        $page->save();

        return response()->json(['status' => 'success', 'page' => $page]);
    }

}
