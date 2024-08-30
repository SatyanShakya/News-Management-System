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
                    {{ $author->name }}
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

    <!-- Page heading -->
    <div class="container p-t-4 p-b-40">
        <h2 class="f1-l-1 cl2">
            {{ $author->name }}
        </h2>
    </div>

    <!-- Post -->
<section class="bg0 p-b-55">
    <div class="container">
        <div class="row justify-content-center">
            @if ($posts->isEmpty())
                <div class="alert alert-light text-center" role="alert">
                    <h4 class="alert-heading" style="font-size: 20px">No Posts Found</h4>
                </div>
                @else
            <div class="col-md-10 col-lg-12 p-b-80">
                <div class="p-r-10 p-r-0-sr991">
                    <div class="m-t--40 p-b-40">
                        <!-- Item post -->
                        @foreach ($posts as $post)
                            <div class="flex-wr-sb-s p-t-40 p-b-15 how-bor2">
                                <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                    class="size-w-8 wrap-pic-w hov1 trans-03 w-full-sr575 m-b-25"
                                    title="{{ $post->title }}">
                                    <img src="{{ $post->image_link }}" alt="IMG">
                                </a>

                                <div class="size-w-9 w-full-sr575 m-b-25">
                                    <h5 class="p-b-12">
                                        <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                            class="f1-l-1 cl2 hov-cl10 trans-03 respon2" title="{{ $post->title }}">
                                            {{ $post->title }}
                                        </a>
                                    </h5>

                                    <div class="cl8 p-b-18">
                                        <span class="f1-s-3">
                                            {{ $post->created_at->format('M j') }}
                                        </span>
                                    </div>

                                    <p class="f1-s-1 cl6 p-b-24">
                                        {{ $post->summary }}
                                    </p>

                                    <a href="{{ route('frontend.newsdetail', $post->id) }}"
                                        class="f1-s-1 cl9 hov-cl10 trans-03" title="Read More">
                                        Read More
                                        <i class="m-l-2 fa fa-long-arrow-alt-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination -->
                        @if ($posts->total() > $posts->perPage())
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
            @endif
        </div>
    </div>
</section>

@endsection
