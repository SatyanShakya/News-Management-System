<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;
use App\Models\post;
use App\Models\Author;
use App\Models\category;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function newsList($slug)
    {

        $category = Category::where('slug', $slug)->where('published', 1)->first();

        if (!$category) {
            abort(404);
        }
        $posts = null;

        if ($category) {
            $posts = $category->posts()
                ->with(['authors' => function ($query) {
                    $query->where('published', 1);
                }])
                ->where('published', 1)
                ->latest()
                ->paginate(10);
        }

        return view("frontend.listing", compact("category", "posts"));
    }

    public function newsDetail($id)
    {

        $post = Post::where("id", $id)->where('published', 1)->first();

        if (!$post) {
            abort(404);
        }

        return view('frontend.newsdetail', compact('post'));
    }

    public function authorList($id)
    {
        $author = Author::where("id", $id)->where('published', 1)->first();

        if (!$author) {
            abort(404);
        }


        $posts = $author->posts()
            ->where('published', 1)
            ->latest()
            ->paginate(10);

        return view('frontend.authorpost', compact('author', 'posts'));
    }
    public function searchList(Request $request)
    {
        $keyword = $request->input('keyword');

        if ($keyword) {
            $posts = Post::where('title', 'like', '%' . $keyword . '%')
                ->where('published', 1)
                ->paginate(10);

            return view('frontend.searchlist', compact('posts', 'keyword'));
        } else {
            return redirect()->back();
        }
    }

    public function pageList($slug)
    {
        $page = Page::where('slug', $slug)->where('published', 1)->first();

        if (!$page) {
            abort(404);
        }

        return view('frontend.pagelist', compact('page'));
    }

    public function contactUs()
    {
        return view('frontend.contactus');
    }

    public function sendContactUs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'address' => 'required',
    
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $recaptchaResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Le-Q-0pAAAAABT45gg5GGa_yyRzcjX-P4yLR_C_&response=' . $request->recaptcha_token);
        $recaptchaResult = json_decode($recaptchaResponse);

        if (!$recaptchaResult->success) {
            return response()->json(['errors' => ['recaptcha_token' => 'reCAPTCHA verification failed']], 422);
        }

            Mail::to('your-mailtrap-email@example.com')->send(new ContactEmail($request->all()));

            return response()->json(['success' => 'Your contact has been received']);
    }
}
