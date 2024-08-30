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
                        @can('post-create')
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('post.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>

                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($posts->isEmpty())
                <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                    No Posts to show
            </div>
                @else

                <div class="row">

                    <section class="col-lg-12 connectedSortable">

                        <div class="card">

                            <div class="card-body">

                                {{-- {{ dd(session('success')) }} --}}

                                @if (session('success'))
                                    <script>
                                        Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: "{{ session('success') }}",
                                        showConfirmButton: false,
                                        timer: 2000
                                     });
                                    </script>
                                @endif

                                <table class="table table-bordered">
                                    <colgroup>
                                        <col style="width: 50px;">
                                        <col style="width: 100px;">
                                        <col style="width: 300px;">
                                        <col style="width: 300px;">
                                        <col style="width: 90px;">
                                        <col style="width: 100px;">
                                        @canany(['post-edit', 'post-delete'])
                                        <col style="width: 100px;">
                                        @endcanany
                                    </colgroup>
                                    <thead class="table-dark table-striped" style="font-size: 18px;">
                                        <tr>
                                            <th scope="col"  class="text-center">S.N</th>
                                            <th scope="col"  class="text-center">Title</th>
                                            <th scope="col"  class="text-center">Content</th>
                                            <th scope="col"  class="text-center">Summary</th>
                                            <th scope="col"  class="text-center">Published</th>
                                            <th scope="col"  class="text-center">Image</th>
                                        @canany(['post-edit', 'post-delete'])
                                            <th scope="col"  class="text-center">Action</th>
                                        @endcanany
                                        </tr>
                                    </thead>

                                    @foreach ($posts as $post)

                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $loop->index + 1 }}</td> {{-- for S.n --}}
                                                <td>{{ $post->title }}</td>
                                                <td>
                                                    @if (strlen($post->content) > 150)
                                                        {!! substr($post->content, 0, 150) !!}...
                                                    @else
                                                        {!! $post->content !!}
                                                    @endif
                                                </td>

                                                <td>
                                                    @if (strlen($post->summary) > 150)
                                                        {{ substr($post->summary, 0, 150) }}...
                                                    @else
                                                        {{ $post->summary }}
                                                    @endif
                                                </td>

                                                <td class="text-center">
                                                    @can('post-edit')
                                                    <input type="checkbox" data-id="{{ $post->id }}"
                                                        data-toggle="toggle" name="published" class="toggle-class"
                                                        data-on="ON" data-off="OFF"
                                                        {{ $post->published == '1' ? 'checked' : '' }}>
                                                        @else
                                                        <input type="checkbox" data-id="{{ $post->id }}"
                                                            data-toggle="toggle" name="published" class="toggle-class"
                                                            data-on="ON" data-off="OFF"
                                                            {{ $post->published == '1' ? 'checked' : '' }} disabled>
                                                    @endcan
                                                </td>

                                                @if ($post->image)
                                                    <td class="text-center">
                                                        <img src="{{ asset('/images/posts/' . $post->image) }}"
                                                            alt="Image" height="200px" width="200px">
                                                    </td>
                                                @else
                                                    <td class="text-center">
                                                        <img src="{{ asset('images/posts/default.png') }}" alt="Image"
                                                            height="200px" width="200px">
                                                    </td>
                                                @endif

                                        @canany(['post-edit', 'post-delete'])

                                                <td>

                                                    <div class="d-flex justify-content-center">
                                                        @can('post-edit')
                                                        <a href="{{ route('post.edit', $post->id) }}"
                                                            class="btn btn-primary mr-2" style="width: 80px;">Edit</a>
                                                        @endcan

                                                        @can('post-delete')
                                                            <form id="delete-form-{{ $post->id }}" action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return false;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" onclick="ShowAlert({{ $post->id }})" class="btn btn-danger" style="width: 80px;">Delete</button>
                                                            </form>
                                                        @endcan

                                                    </div>
                                                </td>
                                        @endcanany
                                            </tr>
                                        </tbody>
                                    @endforeach
                                </table>

                                {{-- Pagination --}}
                                <div style="display: flex; justify-content: space-between;">
                                    <div>
                                        Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} results
                                    </div>
                                    <div>
                                        {{ $posts->links() }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        @endif
                </div>
        </section>

    </div>
@endsection

@section('js')
    <script>
        // message only for 2 sec
        setTimeout(function() {
            document.getElementById('alert-message').style.display = 'none';
        }, 2000);
    </script>



<script>
    $(document).ready(function() {
        $('.toggle-class').change(function() {
            var postId = $(this).data('id');
            var published = $(this).prop('checked') ? 1 : 0;
            var url = "/cms/post/toggle/" + postId;

            $.ajax({
                type: 'POST',
                dataType: 'json', 
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'published': published
                },
                success: function(data) {
                    // Update the button state based on the response
                    if (data.status === 'success') {
                        var post = data.post;
                        var toggleButton = $('input[data-id="' + post.id + '"].toggle-class');
                        toggleButton.prop('checked', post.published == 1);

                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: ' status changed successfully',
                            icon: 'success',
                            timer: 2000, // 2 seconds
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
    });
</script>

    {{-- sweet alert --}}
    <script>
        function ShowAlert(postId) {
            Swal.fire({
                title: "Delete?",
                text: "Are you sure you want to delete this ?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes",
            }).then((result) => {
                if (result.isConfirmed) {
                    // If user confirms, submit the form
                    document.getElementById(`delete-form-${postId}`).submit();
                }
            });
        }
    </script>
@endsection
