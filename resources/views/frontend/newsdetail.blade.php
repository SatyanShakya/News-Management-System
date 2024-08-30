@extends('layouts.frontend')
@section('content')
    <!-- Breadcrumb -->

    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <span class="breadcrumb-item f1-s-3 cl9">
                    Home
                </span>
                @foreach ($post->categories->take(1) as $category)
                    <span class="breadcrumb-item f1-s-3 cl9">
                        {{ $category->name }}
                    </span>
                @endforeach
                <span class="breadcrumb-item f1-s-3 cl9">
                    {{ $post->title }}
                </span>
            </div>

            <form action="{{ route('frontend.search') }}" method="GET">
                <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                        <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="keyword" placeholder="Search" value="{{ request()->query('keyword') }}">
                        <button type="submit" class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                </div>
            </form>
        </div>
    </div>


    <section class="bg0 p-b-140 p-t-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-10 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                        <!-- Blog Detail -->
                        <div class="p-b-70">
                            @foreach ($post->categories->take(1) as $category)
                                <a href="{{ route('frontend.newslist', $category->slug) }}" class="f1-s-10 cl2 hov-cl10 trans-03 text-uppercase" title="{{ $category->name }}">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                            <h3 class="f1-l-3 cl2 p-b-16 p-t-33 respon2">
                                {{ $post->title }}
                            </h3>

                            <div class="flex-wr-s-s p-b-40">
                                <span class="f1-s-3 cl8 m-r-15">
                                    @foreach ($post->authors as $author)
                                        <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03"  title="{{ $author->name }}">
                                            {{ $loop->last ? $author->name : $author->name . ', ' }}
                                        </a>
                                    @endforeach
                                    <span class="m-rl-3">-</span>

                                    <span>
                                        {{ $post->created_at->format('M j') }}
                                    </span>
                                </span>
                            </div>

                            <div class="wrap-pic-max-w p-b-30">
                                <img src="{{ $post->image_link }}" alt="IMG">
                            </div>

                            <p class="f1-s-11 cl6 p-b-25">
                                {!! $post->content !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
