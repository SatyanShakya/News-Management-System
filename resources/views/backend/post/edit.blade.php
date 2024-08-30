@extends('layouts.dashboard')

@section('content')



<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Post Module</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <a href="{{ route('post.create') }}" class="btn btn-primary " style="font-size: 18px; border-radius: 18px;">Create</a>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{-- <div class="row">
            </div> --}}
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">

                        <div class="card-body">


    {!! Form::model($post, [
        'route' => ['post.update', $post->id],
        'method' => 'post',
        'enctype' => 'multipart/form-data',
    ]) !!}

    @method('PUT')

    @include('backend.post.form')

    <div class="card-footer" style="background-color: #fff;">
        {!! Form::submit('Update', ['class' => 'btn btn-success']) !!}
        <a href="{{ route('post.index') }}" class="btn btn-danger">Cancel</a>
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
















    {{-- <form method="post" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data" id="postForm">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $post->title }}">
            <span class="text-danger">
                @error('title')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <label class="form-label">Content</label>
            <textarea name="content" id="content" >{!! $post->content !!}</textarea>

            <span class="text-danger">
                @error('content')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <label class="form-label">Summary</label>
            <textarea name="summary" class="form-control" >{!! $post->summary !!}</textarea>

            <span class="text-danger">
                @error('summary')
                    {{ $message }}
                @enderror
            </span>
        </div>

        <div class="mb-3">
            <label class="form-label">Published</label>
            <input type="checkbox" checked data-toggle="toggle" name="published" class="toggle-class" id="publishedToggle" value="{{ $post->published }}">
            <span class="text-danger">
                @error('published')
                    {{ $message }}
                @enderror
            </span>
            </span>
        </div>

        <div class="mb-3">
            <label class="form-label">Featured Image</label>
            <input type="file" class="form-control" name="image" value="{{ $post->image }}">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('post.index') }}" class="btn btn-danger">Cancel</a>
    </form> --}}
