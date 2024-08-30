@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Category Module</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('category.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-body">

                                {!! Form::model($category, [
                                    'route' => ['category.update', $category->id],
                                    'method' => 'post',
                                ]) !!}

                                @method('PUT')

                                @include('backend.category.form')

                                <div class="card-footer" style="background-color: #fff;">
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}

                                    <a href="{{ route('category.index') }}" class="btn btn-danger"
                                        style='width:80px'>Cancel</a>
                                </div>

                                {!! Form::close() !!}

                                <script>
                                    // Convert toggle button value to 0 or 1 before form submission
                                    document.getElementById('postForm').addEventListener('submit', function(event) {
                                        const publishedToggle = document.getElementById('publishedToggle');
                                        if (publishedToggle.checked) {
                                            publishedToggle.value = 1;
                                        } else {
                                            publishedToggle.value = 0;
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                </div>

        </section>

    </div>
@endsection
