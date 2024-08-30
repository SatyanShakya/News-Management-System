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
                    About
                </span>
                <span class="breadcrumb-item f1-s-3 cl9">
                    {{ $page->title }}
                </span>
            </div>

            <form action="{{ route('frontend.search') }}" method="GET">
                <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                    <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="keyword" placeholder="Search"
                        value="{{ request()->query('keyword') }}">
                    <button type="submit" class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>


    <!-- Page heading -->
    <div class="container p-t-4 p-b-35">
        <h2 class="f1-l-1 cl2">
            {{ $page->title }}
        </h2>
    </div>

    <!-- Content -->
    <section class="bg0 p-b-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-12 p-b-30">
                    <div class="p-r-10 p-r-0-sr991">
                        <p class="f1-s-11 cl6 p-b-25">
                            {!! $page->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
