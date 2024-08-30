<?php

namespace App\Providers;

use App\Models\Page;
use App\Models\Field;

use App\Models\category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.frontend', function ($view) {
            $categories = category::where('published', '1')->latest()->get();
            $pages = Page::where('published', '1')->latest()->get();


            $fields = Field::all();
            $seo = [];

            foreach ($fields as $field) {
                $seo[$field->field_name] = $field->value;
            }

            // $seo['site-name']);

            // $seo=[
            //     'sitename' => Field::where("field_name", "site-name")->value('value'),
            //     'sitedescription'=>Field::where("field_name", "site-description")->value('value'),
            //     'youtubelink'=>Field::where('field_name', 'youtube-link')->value('value'),
            //     'facebooklink'=>Field::where('field_name', 'facebook-link')->value('value'),
            //     'twitterlink'=>Field::where('field_name', 'twitter-link')->value('value'),
            // ];

            $view->with('seo', $seo);
            $view->with('categories', $categories);
            $view->with('pages', $pages);




        });
    }
}


     // $sitename = Field::where("field_name", "site-name")->value('value');
            // $sitedescription = Field::where("field_name", "site-description")->value('value');
            // $facebooklink = Field::where('field_name', 'facebook-link')->value('value');
            // $twitterlink = Field::where('field_name', 'twitter-link')->value('value');
            // $youtubelink = Field::where('field_name', 'youtube-link')->value('value');
            // $categories = category::where('published', '1')->latest()->get();


            // $view->with('sitename', $sitename);
            // $view->with('sitedescription', $sitedescription);
            // $view->with('facebooklink', $facebooklink);
            // $view->with('twitterlink', $twitterlink);
            // $view->with('youtubelink', $youtubelink);
            // $view->with('categories', $categories);

// $seo['sitename']=Field::where("field_name", "site-name")->value('value');
// $seo['sitename']=Field::where("field_name", "site-name")->value('value');


// $view->with('seo', $seo);
