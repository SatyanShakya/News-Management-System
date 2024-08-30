<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{ $seo['site-name'] }}</title>
    <meta charset="UTF-8">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('frontend/images/icons/favicon.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/fonts/fontawesome-5.0.8/css/fontawesome-all.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frontend/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/vendor/animsition/css/animsition.min.css') }}"> --}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/util.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">


            <!-- Header Mobile -->
            <div class="wrap-header-mobile">
                <!-- Logo moblie -->
                <div class="logo-mobile">
                    <a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend/images/icons/logo-01.png') }}"
                            alt="IMG-LOGO"></a>
                </div>

                <!-- Button show menu -->
                <div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </div>
            </div>

            <!-- Menu Mobile -->
            <div class="menu-mobile">

                <ul class="main-menu-m">
                    <li>
                        <a href="{{ route('frontend.home') }}">Home</a>
                    </li>



                    @foreach ($categories as $index => $category)
                        @if ($index < 6)
                            <li>
                                <a href="">{{ $category->name }}</a>
                            </li>
                        @endif
                    @endforeach
                    @if (count($categories) > 6)
                        <li>
                            <a href="#">More</a>
                            <ul class="sub-menu">
                                @foreach ($categories as $index => $category)
                                    @if ($index >= 6)
                                        <li>
                                            <a href="">{{ $category->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="#">More</a>
                            <ul class="sub-menu-m">
                                <li><a href="category-01.html">Category Page v1</a></li>
                                <li><a href="category-02.html">Category Page v2</a></li>
                                <li><a href="blog-grid.html">Blog Grid Sidebar</a></li>
                                <li><a href="blog-list-01.html">Blog List Sidebar v1</a></li>
                                <li><a href="blog-list-02.html">Blog List Sidebar v2</a></li>
                                <li><a href="blog-detail-01.html">Blog Detail Sidebar</a></li>
                                <li><a href="blog-detail-02.html">Blog Detail No Sidebar</a></li>
                                <li><a href="about.html">About Us</a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>

                            <span class="arrow-main-menu-m">
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </span>
                        </li>
                    @endif

                </ul>
            </div>

            <!--  -->
            <div class="wrap-logo no-banner container">
                <!-- Logo desktop -->
                <div class="logo">
                    <a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend/images/icons/logo-01.png') }}"
                            alt="LOGO"></a>
                </div>
            </div>

            <!--  -->
            <div class="wrap-main-nav">
                <div class="main-nav">
                    <!-- Menu desktop -->
                    <nav class="menu-desktop">
                        <a class="logo-stick" href="index.html">
                            <img src="{{ asset('frontend/images/icons/logo-01.png') }}" alt="LOGO">
                        </a>
                        <ul class="main-menu justify-content-center">
                            <li>
                                <a href="{{ route('frontend.home') }}">Home</a>
                            </li>
                            @if ($pages->isNotEmpty())
                                <li class="more-icon">
                                    <a href="">About</a>
                                    <ul class="sub-menu">
                                        @foreach ($pages as $page)
                                            <li>
                                                <a
                                                    href="{{ route('frontend.pagelist', $page->slug) }}">{{ $page->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            @foreach ($categories as $index => $category)
                                @if ($index < 6)
                                    <li>
                                        <a
                                            href="{{ route('frontend.newslist', $category->slug) }}">{{ $category->name }}</a>
                                    </li>
                                @endif
                            @endforeach
                            @if (count($categories) > 6)
                                <li class="more-icon">
                                    <a href="">More</a>
                                    <ul class="sub-menu">
                                        @foreach ($categories as $index => $category)
                                            @if ($index >= 6)
                                                <li>
                                                    <a
                                                        href="{{ route('frontend.newslist', $category->slug) }}">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('frontend.contact') }}">Contact</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>


    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="bg2 p-t-40 p-b-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 p-b-20">
                        <div class="size-h-3 flex-s-c">
                            <a href="{{ route('frontend.home') }}">
                                <img class="max-s-full" src="{{ asset('/frontend/images/icons/logo-02.png') }}"
                                    alt="LOGO">
                            </a>
                        </div>

                        <div>
                            <p class="f1-s-1 cl11 p-b-16">
                                {{ $seo['site-description'] }}
                            </p>

                            <div class="p-t-15">

                                @if (!empty($seo['facebook-link']))
                                    <a href="{{ $seo['facebook-link'] }}" class="fs-18 cl11 hov-cl10 trans-03 m-r-8"
                                        target="_blank">
                                        <span class="fab fa-facebook-f"></span>
                                    </a>
                                @endif

                                @if (!empty($seo['twitter-link']))
                                    <a href="{{ $seo['twitter-link'] }}" class="fs-18 cl11 hov-cl10 trans-03 m-r-8"
                                        target="_blank">
                                        <span class="fab fa-twitter"></span>
                                    </a>
                                @endif

                                @if (!empty($seo['youtube-link']))
                                    <a href="{{ $seo['youtube-link'] }}" class="fs-18 cl11 hov-cl10 trans-03 m-r-8"
                                        target="_blank">
                                        <span class="fab fa-youtube"></span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    @if ($categories->isnotempty())

                        <div class="col-sm-6 col-lg-6 p-b-20">
                            <div class="size-h-3 flex-s-c">
                                <h5 class="f1-m-7 cl0">
                                    Category
                                </h5>
                            </div>
                            @foreach ($categories->take(4) as $category)
                                <ul class="m-t--12">
                                    <li class="how-bor1 p-rl-5 p-tb-10">
                                        <a href="#" class="f1-s-5 cl11 hov-cl10 trans-03 p-tb-8">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                </ul>
                            @endforeach

                        </div>

                    @endif
                </div>
            </div>
        </div>

        <div class="bg11">
            <div class="container size-h-4 flex-c-c p-tb-15">
                <span class="f1-s-1 cl0 txt-center">

                    <a href="#" class="f1-s-1 cl10 hov-link1">
                        &copy
                        <script>
                            document.write(new Date().getFullYear());
                        </script>{{ $seo['site-name'] }}. All rights reserved <a
                            href="https://colorlib.com" target="_blank"></a>
                </span>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <span class="fas fa-angle-up"></span>
        </span>
    </div>

    <!-- Modal Video 01-->
    <div class="modal fade" id="modal-video-01" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document" data-dismiss="modal">
            <div class="close-mo-video-01 trans-0-4" data-dismiss="modal" aria-label="Close">&times;</div>

            <div class="wrap-video-mo-01">
                <div class="video-mo-01">
                    <iframe src="https://www.youtube.com/embed/wJnBTPUQS5A?rel=0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>



    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    {{-- <script src="{{ asset('frontend/vendor/animsition/js/animsition.min.js') }}"></script> --}}
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @if (request()->routeIs('frontend.contact'))
    <script src="https://www.google.com/recaptcha/api.js?render=6Le-Q-0pAAAAAKo_YqN7X1Vv-EA9OPMDibbqpGge"></script>
@endif

    @yield('js')

</body>

</html>
