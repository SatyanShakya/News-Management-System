<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

     {{-- sweet alert --}}
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/qo5qiq45zjchcsprfzxvoxwcgezt9ej8xjyroj1e519pcqwf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav" >
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"  style="font-size: 20px;"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
            <a style="font-size: 20px;" class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
         {{-- <a href="{{ url('/cms/dashboard') }}" class="brand-link" >
            <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                style="opacity: 5.8">
            <span class="brand-text font-weight-light" style="font-size: 25px; font-family: 'Arial', sans-serif; font-style: oblique; ">CMS</span>
        </a> --}}

        <a href="{{ url('/cms/dashboard') }}" class="brand-link d-flex align-items-center justify-content-center" style="gap: 10px;">
            {{-- <i class="fab fa-laravel" style="font-size: 25px;"></i> --}}

            <i class="fas fa-bug"></i>

            <span class="brand-text font-weight-light" style="font-size: 25px; font-family: 'Arial', sans-serif; font-style: oblique;">CMS</span>
        </a>



        <!-- Sidebar -->
        <div class="sidebar">

             <!-- Display logged-in user's image and name -->
             <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    @if(Auth::user()->image)
                        <img src="{{ asset('images/user/' . Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
                     @else
                          <img src="{{ asset('images/user/default.jpg') }}" class="img-circle elevation-2" alt="User Image">
                     @endif
                </div>
                <div class="info">
                    <a href="" class="d-block"  style="opacity: 5.8; font-size: 20px;">{{ Auth::user()->name }}</a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">

                        <a href="{{ url('/cms/dashboard') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"  style="opacity: 5.8; font-size: 20px;"></i>
                            <p style="font-size: 18px; font-family: 'Arial', sans-serif; ">
                                Dashboard
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        @canany(['user-view', 'role-view'])              {{--  or ko kam garxa --}}
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-user-tie"  style="opacity: 5.8; font-size: 20px;"></i>
                            <p style="font-size: 18px; font-family: 'Arial', sans-serif; ">
                                User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>

                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @can('user-view')

                                <a href="{{ route('user.index') }}" class="nav-link active">
                                    {{-- asd asuhd asudh asiud hasiudh asud haiudh audhasudh ausdh uaihd uah duah sdui hasuidhasud hasudhasihd --}}
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User</p>
                                </a>

                                @endcan
                            </li>

                            <li class="nav-item">
                                @can('role-view')

                                <a href="{{ route('role.index') }}" class="nav-link active">

                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Role</p>
                                </a>

                                @endcan
                            </li>

                            <li class="nav-item">
                                @can('permission-view')

                                <a href="{{ route('permision.index') }}" class="nav-link active">

                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permission</p>
                                </a>

                                @endcan
                            </li>
                     </ul>
                     @endcanany
            </li>

                    <li class="nav-item">
                        @canany(['post-view', 'category-view', 'author-view'])

                                <a href="#" class="nav-link ">
                                    <i class="nav-icon fas fa-book"  style="opacity: 5.8; font-size: 20px;"></i>

                                    <p style="font-size: 18px; font-family: 'Arial', sans-serif; ">
                                        Post
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>

                            <ul class="nav nav-treeview">

                                    <li class="nav-item">
                                        @can('post-view')
                                        <a href="{{ route('post.index') }}" class="nav-link active">
                                            {{-- asd asuhd asudh asiud hasiudh asud haiudh audhasudh ausdh uaihd uah duah sdui hasuidhasud hasudhasihd --}}
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Post</p>
                                        </a>
                                        @endcan
                                    </li>

                                    <li class="nav-item">
                                        @can('category-view')

                                        <a href="{{  route('category.index') }}" class="nav-link active">

                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Category</p>
                                        </a>

                                        @endcan
                                    </li>

                                    <li class="nav-item">
                                        @can('author-view')

                                        <a href="{{  route('author.index') }}" class="nav-link active">

                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Author</p>
                                        </a>

                                        @endcan
                                    </li>
                             </ul>

                             @endcanany
                    </li>

                    <li class="nav-item">
                        @can('page-view')

                        <a href="{{ route('page') }}" class="nav-link">
                            <i class="nav-icon fas fa-solid fa-scroll"  style="opacity: 5.8; font-size: 20px;"></i>

                            <p style="font-size: 18px; font-family: 'Arial', sans-serif; ">
                                Page
                            </p>
                        </a>

                        @endcan
                    </li>

                    <li class="nav-item">
                        @can('seo-view')

                        <a href="{{ route('fields.index') }}" class="nav-link">
                            <i class="nav-icon fab fa-searchengin"  style="opacity: 5.8; font-size: 20px;"></i>
                            <p style="font-size: 18px; font-family: 'Arial', sans-serif; ">
                                SEO
                            </p>
                        </a>

                        @endcan
                    </li>


                </ul>

            </nav>

        </div>

    </aside>

    @yield('content')

    </div>
    </section>

    </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>

    <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>

    {{-- select 2 --}}
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    {{-- <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/qo5qiq45zjchcsprfzxvoxwcgezt9ej8xjyroj1e519pcqwf/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();

            // Initialize Select2 with Bootstrap 4 theme
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });
        });
    </script>


    @yield('js')


    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
        tinymce.init({
        selector: 'textarea#content',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
    </script>

    <script>
        tinymce.init({
        selector: 'textarea#description',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
    </script>


    <script>
        tinymce.init({
        selector: 'textarea#descriptionedit',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });
    </script>

{{-- // sluggable --}}
    <script>
        $("#name").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#slug").val(Text);
        });
    </script>

    <script>
        $("#title").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();

        // Replace non-alphabetic characters (except spaces) with an empty string
        Text = Text.replace(/[^a-z\s]/g, '');

        // Replace spaces with hyphens
        Text = Text.replace(/\s+/g, '-');

        $("#slug").val(Text);
        });
    </script>


    <script>
        $("#titleedit").keyup(function() {
        var Text = $(this).val();
        Text = Text.toLowerCase();
        var regExp = /\s+/g;
        Text = Text.replace(regExp,'-');
        $("#slugedit").val(Text);
        });
    </script>

</body>
</html>
