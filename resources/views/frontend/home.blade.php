@extends('layouts.frontend')
@section('content')

    <!-- Headline -->
    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">

            <div class="f2-s-1 p-r-30 m-tb-6">
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

    <!-- Post -->
    <section class="bg0 p-t-70">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-12">
                    <div class="p-b-20">

                        <!-- Template 1 -->
                        @if ($homeSections['template1']['categories']->isNotEmpty())
                            @if ($homeSections['template1']['posts']->isNotEmpty())
                                <div class="p-b-20">
                                    @foreach (collect($homeSections)->take(1) as $section)
                                        <div class="how2 how2-cl1 flex-sb-c m-r-10 m-r-0-sr991">
                                            <h3 class="f1-m-2 cl12 tab01-title">
                                                {{ $section['category']->name }}
                                            </h3>

                                            <a href="{{ route('frontend.newslist', $section['category']->slug) }}"
                                                class="tab01-link f1-s-1 cl9 hov-cl10 trans-03" title="View all">
                                                View all
                                                <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                            </a>
                                        </div>
                                    @endforeach

                                    <div class="row p-t-35">
                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            @foreach (collect($section['posts'])->take(1) as $post)
                                                <!-- Item post -->
                                                <div class="m-b-30">
                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                        class="wrap-pic-w hov1 trans-03" title="{{ $post->title }}">
                                                        <img src="{{ $post->image_link }}" alt="IMG">
                                                    </a>

                                                    <div class="p-t-20">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            @foreach ($post->authors as $index => $author)
                                                                <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                    {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                </a>
                                                            @endforeach

                                                            <span class="f1-s-3 m-rl-3">
                                                                -
                                                            </span>

                                                            <span class="f1-s-3">
                                                                {{ $post->created_at->format('M j') }}
                                                            </span>
                                                        </span>

                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            <!-- Item post -->
                                            @foreach (collect($section['posts'])->slice(1, 4) as $post)
                                                <div class="flex-wr-sb-s m-b-30">

                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                        class="size-w-1 wrap-pic-w hov1 trans-03"
                                                        title="{{ $post->title }}">
                                                        <img src="{{ $post->image_link }}">
                                                    </a>

                                                    <div class="size-w-2">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            @foreach ($post->authors as $index => $author)
                                                                <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                    {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                </a>
                                                            @endforeach
                                                            <span class="f1-s-3 m-rl-3">
                                                                -
                                                            </span>

                                                            <span class="f1-s-3">
                                                                {{ $post->created_at->format('M j') }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Template 2 -->
                        <div class="row">
                            @if ($homeSections['template2']['posts1']->isNotEmpty())
                                @if ($homeSections['template2']['category1']->isNotEmpty())
                                    <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                                        @php
                                            $Category = collect($homeSections['template2']['category1'])->first();
                                        @endphp
                                        <div class="how2 how2-cl2 flex-sb-c m-b-35">
                                            <h3 class="f1-m-2 cl13 tab01-title">
                                                {{ $Category->name }}
                                            </h3>

                                            <a href="{{ route('frontend.newslist', $Category->slug) }}"
                                                class="tab01-link f1-s-1 cl9 hov-cl10 trans-03" title="View all">
                                                View all
                                                <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                            </a>

                                        </div>

                                        <!-- Main Item post -->
                                        @foreach ($homeSections['template2']['posts1']->take(1) as $post)
                                            <div class="m-b-30">
                                                <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                    class="wrap-pic-w hov1 trans-03" title="{{ $post->title }}">
                                                    <img src="{{ $post->image_link }}" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                            class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            {{ $post->title }}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        @foreach ($post->authors as $index => $author)
                                                            <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                            </a>
                                                        @endforeach

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ $post->created_at->format('M j') }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach

                                        <!-- Item post -->
                                        @foreach ($homeSections['template2']['posts1']->slice(1, 2) as $post)
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                    title="{{ $post->title }}" class="size-w-1 wrap-pic-w hov1 trans-03">
                                                    <img src="{{ $post->image_link }}"
                                                        alt="IMGDonec metus orci, malesuada et lectus vitae">
                                                </a>


                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                            class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            {{ $post->title }}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        @foreach ($post->authors as $index => $author)
                                                            <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                            </a>
                                                        @endforeach
                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ $post->created_at->format('M j') }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif

                            <!-- Template  2-->
                            @if ($homeSections['template2']['posts2']->isNotEmpty())
                                @if ($homeSections['template2']['category2']->isNotEmpty())
                                    <div class="col-sm-6 p-r-25 p-r-15-sr991 p-b-25">
                                        @php
                                            $Category = collect($homeSections['template2']['category2'])->first();
                                        @endphp
                                        <div class="how2 how2-cl6 flex-sb-c m-b-35">
                                            <h3 class="f1-m-2 cl18 tab01-title">
                                                {{ $Category->name }}
                                            </h3>

                                            <a href="{{ route('frontend.newslist', $Category->slug) }}"
                                                class="tab01-link f1-s-1 cl9 hov-cl10 trans-03" title="View all">
                                                View all
                                                <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                            </a>
                                        </div>

                                        <!-- Main Item post -->
                                        @foreach ($homeSections['template2']['posts2']->take(1) as $post)
                                            <div class="m-b-30">

                                                <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                    class="wrap-pic-w hov1 trans-03" title="{{ $post->title }}">
                                                    <img src="{{ $post->image_link }}" alt="IMG">
                                                </a>

                                                <div class="p-t-20">
                                                    <h5 class="p-b-5">
                                                        <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                            class="f1-m-3 cl2 hov-cl10 trans-03">
                                                            {{ $post->title }}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        @foreach ($post->authors as $index => $author)
                                                            <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                            </a>
                                                        @endforeach

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ $post->created_at->format('M j') }}
                                                        </span>
                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach

                                        @foreach ($homeSections['template2']['posts2']->slice(1, 2) as $post)
                                            <!-- Item post -->
                                            <div class="flex-wr-sb-s m-b-30">
                                                <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                    class="size-w-1 wrap-pic-w hov1 trans-03"
                                                    title="{{ $post->title }}">
                                                    <img src="{{ $post->image_link }}"
                                                        alt="IMGDonec metus orci, malesuada et lectus vitae">
                                                </a>

                                                <div class="size-w-2">
                                                    <h5 class="p-b-5">
                                                        <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                            class="f1-s-5 cl3 hov-cl10 trans-03">
                                                            {{ $post->title }}
                                                        </a>
                                                    </h5>

                                                    <span class="cl8">
                                                        @foreach ($post->authors as $index => $author)
                                                            <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                            </a>
                                                        @endforeach

                                                        <span class="f1-s-3 m-rl-3">
                                                            -
                                                        </span>

                                                        <span class="f1-s-3">
                                                            {{ $post->created_at->format('M j') }}
                                                        </span>

                                                    </span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Template 4  -->
                        @if ($homeSections['template4']['category']->isNotEmpty())
                            @if ($homeSections['template4']['posts']->isNotEmpty())
                                <div class="p-b-25 p-r-10 p-r-0-sr991">
                                    @php
                                        $category = collect($homeSections['template4']['category'])->first();
                                    @endphp
                                    <div class="how2 how2-cl6 flex-sb-c m-b-35">
                                        <h3 class="f1-m-2 cl14 tab01-title">
                                            {{ $category->name }}
                                        </h3>

                                        <a href="{{ route('frontend.newslist', $category->slug) }}"
                                            class="tab01-link f1-s-1 cl9 hov-cl10 trans-03" title="View all">
                                            View all
                                            <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                        </a>
                                    </div>
                                    <div class="flex-wr-sb-s p-t-35">
                                        @foreach ($homeSections['template4']['posts']->take(1) as $post)
                                            <div class="size-w-6 w-full-sr575">
                                                <!-- Item post -->
                                                <div class="m-b-30">
                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                        class="wrap-pic-w hov1 trans-03" title="{{ $post->title }}">
                                                        <img src="{{ $post->image_link }}" alt="IMG">
                                                    </a>

                                                    <div class="p-t-25">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                class="f1-m-3 cl2 hov-cl10 trans-03">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            @foreach ($post->authors as $index => $author)
                                                                <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                    {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                </a>
                                                            @endforeach
                                                            <span class="f1-s-3 m-rl-3">
                                                                -
                                                            </span>

                                                            <span class="f1-s-3">
                                                                {{ $post->created_at->format('M j') }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="size-w-7 w-full-sr575">
                                            @foreach ($homeSections['template4']['posts']->slice(1, 2) as $post)
                                                <!-- Item post -->
                                                <div class="m-b-30">
                                                    <a href="\{{ route('frontend.newsdetail', $post->id) }}"
                                                        class="wrap-pic-w hov1 trans-03" title="{{ $post->title }}">
                                                        <img src="{{ $post->image_link }}" alt="IMG">
                                                    </a>


                                                    <div class="p-t-10">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            @foreach ($post->authors as $index => $author)
                                                                <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                    {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                </a>
                                                            @endforeach

                                                            <span class="f1-s-3 m-rl-3">
                                                                -
                                                            </span>

                                                            <span class="f1-s-3">
                                                                {{ $post->created_at->format('M j') }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Template 5  -->
                        @if ($homeSections['template5']['posts']->isNotEmpty())
                            @if ($homeSections['template5']['category']->isNotEmpty())
                                <div class="p-b-25 m-r--10 m-r-0-sr991">
                                    @php
                                        $category = collect($homeSections['template5']['category'])->first();
                                    @endphp
                                    <div class="how2 how2-cl6 flex-sb-c m-b-35">

                                        <h3 class="f1-m-2 cl17 tab01-title">
                                            {{ $category->name }}
                                        </h3>

                                        <a href="{{ route('frontend.newslist', $category->slug) }}"
                                            class="tab01-link f1-s-1 cl9 hov-cl10 trans-03" title="View all">
                                            View all
                                            <i class="fs-12 m-l-5 fa fa-caret-right"></i>
                                        </a>
                                    </div>

                                    <div class="row p-t-35">

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            @foreach ($homeSections['template5']['posts']->take(2) as $post)
                                                <!-- Item post -->
                                                <div class="flex-wr-sb-s m-b-30">
                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                        class="size-w-1 wrap-pic-w hov1 trans-03"
                                                        title="{{ $post->title }}">
                                                        <img src="{{ $post->image_link }}" alt="IMG">
                                                    </a>


                                                    <div class="size-w-2">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            @foreach ($post->authors as $index => $author)
                                                                <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                    {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                </a>
                                                            @endforeach
                                                            <span class="f1-s-3 m-rl-3">
                                                                -
                                                            </span>

                                                            <span class="f1-s-3">
                                                                {{ $post->created_at->format('M j') }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                            @foreach ($homeSections['template5']['posts']->slice(2, 2) as $post)
                                                <!-- Item post -->
                                                <div class="flex-wr-sb-s m-b-30">
                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                        title="{{ $post->title }}"
                                                        class="size-w-1 wrap-pic-w hov1 trans-03">
                                                        <img src="{{ $post->image_link }}" alt="IMG">
                                                    </a>

                                                    <div class="size-w-2">
                                                        <h5 class="p-b-5">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                class="f1-s-5 cl3 hov-cl10 trans-03">
                                                                {{ $post->title }}
                                                            </a>
                                                        </h5>

                                                        <span class="cl8">
                                                            @foreach ($post->authors as $index => $author)
                                                                <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                    {{ $author->name }}
                                                                </a>
                                                                @if ($index < count($post->authors) - 1)
                                                                    , <!-- Add comma if it's not the last author -->
                                                                @endif
                                                            @endforeach
                                                            <span class="f1-s-3 m-rl-3">
                                                                -
                                                            </span>

                                                            <span class="f1-s-3">
                                                                {{ $post->created_at->format('M j') }}
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- others -->
                        <!-- template 7 -->
                        @if ($homeSections['template5']['category']->isNotEmpty())
                            <div class="tab01 p-b-20">
                                <div class="tab01-head how2 how2-cl1 bocl12 flex-s-c m-r-10 m-r-0-sr991">
                                    <!-- Brand tab -->
                                    <h3 class="f1-m-2 cl12 tab01-title">Others</h3>

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist">
                                        @foreach ($homeSections['template7']['category'] as $index => $category)
                                            @if ($category->posts->where('published', 1)->count() > 0)
                                                <li class="nav-item">
                                                    <a class="nav-link{{ $loop->first ? ' active' : '' }}"
                                                        data-toggle="tab" href="#tab1-{{ $category->id }}"
                                                        role="tab">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                        <li class="nav-item-more dropdown dis-none">
                                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">
                                                <i class="fa fa-ellipsis-h"></i>
                                            </a>
                                            <ul class="dropdown-menu"></ul>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Tab panes -->
                                <div class="tab-content p-t-35">
                                    @foreach ($homeSections['template7']['category'] as $index => $category_tab)
                                        <div class="tab-pane fade {{ $loop->first ? ' show active' : '' }}"
                                            id="tab1-{{ $category_tab->id }}" role="tabpanel">
                                            <div class="row">
                                                @foreach ($category_tab->posts->where('published', 1)->take(1) as $post)
                                                    <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                                        <!-- Item post -->
                                                        <div class="m-b-30">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                                title="{{ $post->title }}"
                                                                class="wrap-pic-w hov1 trans-03">
                                                                <img src="{{ $post->image_link }}" alt="IMG">
                                                            </a>
                                                            <div class="p-t-20">
                                                                <h5 class="p-b-5">
                                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                        class="f1-m-3 cl2 hov-cl10 trans-03">{{ $post->title }}</a>
                                                                </h5>
                                                                <span class="cl8">
                                                                    @foreach ($post->authors as $index => $author)
                                                                        <a href="{{ route('frontend.authorpost', $author->id) }}"
                                                                            class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                            {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                        </a>
                                                                    @endforeach
                                                                    <span class="f1-s-3 m-rl-3">-</span>
                                                                    <span
                                                                        class="f1-s-3">{{ $post->created_at->format('M j') }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <div class="col-sm-6 p-r-25 p-r-15-sr991">
                                                    @foreach ($category_tab->posts->where('published', 1)->slice(1, 3) as $post)
                                                        <!-- Item post -->
                                                        <div class="flex-wr-sb-s m-b-30">
                                                            <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                                                class="size-w-1 wrap-pic-w hov1 trans-03"
                                                                title="{{ $post->title }}">
                                                                <img src="{{ $post->image_link }}" alt="IMG">
                                                            </a>
                                                            <div class="size-w-2">
                                                                <h5 class="p-b-5">
                                                                    <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                                        class="f1-s-5 cl3 hov-cl10 trans-03">{{ $post->title }}</a>
                                                                </h5>
                                                                <span class="cl8">
                                                                    @foreach ($post->authors as $index => $author)
                                                                        <a href="{{ route('frontend.authorpost', $author->id) }}"
                                                                            class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                                            {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                                        </a>
                                                                    @endforeach
                                                                    <span class="f1-s-3 m-rl-3">-</span>
                                                                    <span
                                                                        class="f1-s-3">{{ $post->created_at->format('M j') }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest -->
    <!-- template 6 -->

    @if ($homeSections['template6']['posts']->isNotEmpty())
        <section class="bg0 p-t-50 p-b-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 col-lg-12 p-b-50">
                        <div class="p-r-10 p-r-0-sr991">

                            <div class="how2 how2-cl4 flex-s-c">
                                <h3 class="f1-m-2 cl3 tab01-title">
                                    Latest Posts
                                </h3>
                            </div>
                            @foreach ($homeSections['template6']['posts']->take(4) as $post)
                                <div class="p-b-40">
                                    <!-- Item post -->
                                    <div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
                                        <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                            title="{{ $post->title }}"
                                            class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25">
                                            <img src="{{ $post->image_link }}" alt="IMG">
                                        </a>

                                        <div class="size-w-9 w-full-sr575 m-b-25">
                                            <h5 class="p-b-12">
                                                <a href="{{ route('frontend.newsdetail', $post->id) }}" title="{{ $post->title }}"
                                                    class="f1-l-1 cl2 hov-cl10 trans-03 respon2">
                                                    {{ $post->title }}
                                                </a>
                                            </h5>

                                            <div class="cl8 p-b-18">
                                                @foreach ($post->authors as $index => $author)
                                                    <a href="{{ route('frontend.authorpost', $author->id) }}" class="f1-s-4 cl8 hov-cl10 trans-03" title="{{ $author->name }}">
                                                        {{ $loop->last ? $author->name : $author->name . ', ' }}
                                                    </a>
                                                @endforeach
                                                <span class="f1-s-3 m-rl-3">
                                                    -
                                                </span>

                                                <span class="f1-s-3">
                                                    {{ $post->created_at->format('M j') }}
                                                </span>
                                            </div>

                                            <p class="f1-s-1 cl6 p-b-24">
                                                {{ $post->summary }}
                                            </p>

                                            <a href="{{ route('frontend.newsdetail', $post->id) }}" class="f1-s-1 cl9 hov-cl10 trans-03">
                                                Read More
                                                <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
