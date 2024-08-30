@extends('layouts.frontend')
@section('content')
    <!-- Breadcrumb -->

    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <span class="breadcrumb-item f1-s-3 cl9">
                    Home
                </span>
                <span class="breadcrumb-item f1-s-3 cl9">
                    {{ $category->name }}
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


    <!-- Post -->
    <section class="bg0 p-t-70 p-b-55">
        <div class="container">
            <div class="row justify-content-center">
                @if ($posts->isEmpty())
                <div class="alert alert-light text-center" role="alert">
                    <h4 class="alert-heading" style="font-size: 20px">No Posts Found</h4>
                </div>
                @else
                    <div class="col-md-10 col-lg-10 p-b-80">

                        <div class="row">
                            @foreach ($posts as $post)
                                <div class="col-sm-6 p-r-25 p-r-15-sr991">

                                    <!-- Item latest -->
                                    <div class="m-b-45">
                                        <a href="{{ route('frontend.newsdetail', $post->id) }}" class="wrap-pic-w hov1 trans-03" title="{{ $post->title }}">
                                            <img src="{{ $post->image_link }}" alt="IMG">
                                        </a>

                                        <div class="p-t-16">
                                            <h5 class="p-b-5">
                                                <a href="{{ route('frontend.newsdetail', $post->id) }}" class="f1-m-3 cl2 hov-cl10 trans-03" title="{{ $post->title }}">
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

                        </div>
                @endif

                <!-- Pagination -->
                @if ($posts->total() > 10)
                    <div class="flex-wr-s-c m-rl--7 p-t-15">
                        @if ($posts->onFirstPage())
                            {{-- <a href="#" class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 pagi-active">&laquo;</a> --}}
                        @else
                            <a href="{{ $posts->previousPageUrl() }}"
                                class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7">&laquo;</a>
                        @endif

                        @for ($i = 1; $i <= $posts->lastPage(); $i++)
                            <a href="{{ $posts->url($i) }}"
                                class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7 {{ $posts->currentPage() == $i ? 'pagi-active' : '' }}">{{ $i }}</a>
                        @endfor

                        @if ($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}"
                                class="flex-c-c pagi-item hov-btn1 trans-03 m-all-7">&raquo;</a>
                        @endif
                    </div>
                @endif


            </div>
        </div>
        </div>
    </section>
@endsection
