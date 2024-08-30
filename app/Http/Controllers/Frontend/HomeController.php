<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Field;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\post;

class HomeController extends Controller
{
    public function index()
    {
        // $sitetitle = Field::where("field_name", "site-title")->value('value');
        // $sitedescription = Field::where("field_name", "site-description")->value('value');

        $categories = category::where('published', '1')->latest()->get();

        $category1 = $categories->first();
        $category2 = $categories->slice(1, 2);
        $category3 = $categories->slice(2, 1);
        $category4 = $categories->slice(3, 1);
        $category5 = $categories->slice(4, 1);
        $category6= $categories->slice(5,6);

        $post1 = $category1 ? $category1->posts()
            ->with(['authors' => function ($query) {
                $query->where('published', 1);
            }])
            ->where('published','1')
            ->latest()->get() : null;

        // Fetch posts for each category in category2
        $post2 = $category2->map(function ($category) {
            return $category->posts()
                ->with(['authors' => function ($query) {
                    $query->where('published', 1);
                }])
                ->where('published','1')
                ->latest()->get();
        })->flatten(); // to get a single collection of posts

        $post3 = $category3->map(function ($category) {
            return $category->posts()
                ->with(['authors' => function ($query) {
                    $query->where('published', 1);
                }])
            ->where('published','1')

                ->latest()->get();
        })->flatten();

        $post4 = $category4->map(function ($category) {
            return $category->posts()
            ->with(['authors'=> function ($query) {
                $query->where('published', 1);
            }])
            ->where('published','1')

            ->latest()->get();
        }   )->flatten();

        $post5 = $category5->map(function ($category) {
            return $category->posts()
            ->with(['authors'=> function ($query) {
                $query->where('published', 1);
            }])
            ->where('published','1')

            ->latest()->get();
        }   )->flatten();

        $post6 = $category6->map(function ($category) {
            return $category->posts()
            ->with(['authors'=> function ($query) {
                $query->where('published', 1);
            }])
            ->where('published','1')

            ->latest()->get();
        }   )->flatten();

        $posts = collect();
        foreach ($category6 as $category) {
            $posts = $posts->merge($category->posts()->where('published', '1')->latest()->get());
        }

        $post= post::with(['authors'=> function ($query) {
            $query->where('published', 1);
        }])->where('published','1')->latest()->get();

        $homeSections = [
            'template1' => [
                'categories'=>$categories,
                'category' => $category1,
                'posts' => $post1,
            ],
            'template2' => [
                'category1' => $category2,
                'posts1' => $post2,
                'category2' => $category3,
                'posts2' => $post3,
            ],

            'template4' => [
                'category' => $category4,
                'posts' => $post4,
            ],
            'template5' =>[
                'category' => $category5,
                'posts' => $post5,
            ],
            'template6' =>[
                'posts' => $post,
            ],
            'template7' =>[
                'category' => $category6,

            ],
            'footer' => [
                'category' => $categories,
            ]

        ];
        // dd($homeSections);

        return view("frontend.home", compact( 'categories', 'homeSections'));
    }
}
