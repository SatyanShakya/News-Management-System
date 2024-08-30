@extends('layouts.dashboard')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Author Module</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('author-create')

                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('author.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>

                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($authors->isEmpty())
                    <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                            No Authors to show.
                    </div>
                @else

                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-body">

                                @if (session('success'))
                                <script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Success!',
                                        text: '{{ session('success') }}',
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                </script>
                            @endif

                                @if (session('error'))
                                <script>
                                    Swal.fire("{{ session('error') }}");
                                 </script>
                                @endif

                                <table class="table table-bordered">
                                    <colgroup>
                                        <col style="width: 50px;">
                                        <col style="width: 100px;">
                                        <col style="width: 300px;">
                                        <col style="width: 80px;">
                                        <col style="width: 90px;">
                                        @canany(['author-edit', 'author-delete'])
                                        <col style="width: 100px;">
                                        @endcanany
                                    </colgroup>
                                    <thead class="table-dark table-striped" style="font-size: 18px;">
                                        <tr>
                                            <th scope="col" class="text-center">S.N</th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Description</th>
                                            <th scope="col" class="text-center">Image</th>
                                            <th scope="col" class="text-center">Published</th>
                                        @canany(['author-edit', 'author-delete'])
                                            <th scope="col" class="text-center">Action</th>
                                        @endcanany

                                        </tr>
                                    </thead>
                                    @foreach ($authors as $author)

                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $loop->index + 1 }}</td> {{-- for S.n --}}
                                                <td class="text-center">{{ $author->name }}</td>
                                                <td>
                                                    @if (strlen($author->description) > 150)
                                                        {!! substr($author->description, 0, 150) !!}...
                                                    @else
                                                        {!! $author->description !!}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                @if ($author->image)

                                                        <img src="{{ asset('/images/author/' . $author->image) }}"
                                                            alt="Image" style="max-width: 100px;">
                                                @else
                                                        <img src="{{ asset('/images/author/default.png') }}" alt="Image"
                                                        style="max-width: 100px;">

                                                @endif
                                                </td>
                                                <td class="text-center">
                                                    @can('author-edit')
                                                    <input type="checkbox" data-id="{{ $author->id }}"
                                                        data-toggle="toggle" name="published" class="toggle-class"
                                                        data-on="ON" data-off="OFF"
                                                        {{ $author->published == '1' ? 'checked' : '' }}>
                                                    @else
                                                    <input type="checkbox" data-id="{{ $author->id }}"
                                                    data-toggle="toggle" name="published" class="toggle-class"
                                                    data-on="ON" data-off="OFF"
                                                    {{ $author->published == '1' ? 'checked' : '' }} disabled>
                                                    @endcan
                                                </td>
                                        @canany(['author-edit', 'author-delete'])
                                                <td class="text-center">

                                                    <div class="d-flex justify-content-center">
                                                        @can('author-edit')

                                                        <a href="{{ route('author.edit', $author->id) }}"
                                                            class="btn btn-primary mr-2" style="width: 80px;">Edit</a>

                                                        @endcan

                                                        @can('author-delete')

                                                            <form id="delete-form-{{ $author->id }}" action="{{ route('author.destroy', $author->id) }}" method="POST" onsubmit="return false;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" onclick="ShowAlert({{ $author->id }})" class="btn btn-danger" style="width: 80px;">Delete</button>
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
                                        Showing {{ $authors->firstItem() }} to {{ $authors->lastItem() }} of {{ $authors->total() }} results
                                    </div>

                                    <div>
                                        {{ $authors->links() }}
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
        setTimeout(function() {
            document.getElementById('alert-message').style.display = 'none';
        }, 2000);
    </script>



<script>
    $(document).ready(function() {
        $('.toggle-class').change(function() {
            var authorId = $(this).data('id');
            var published = $(this).prop('checked') ? 1 : 0;
            var url = "/cms/author/toggle/" + authorId;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: url,
                data: {
                    '_token': '{{ csrf_token() }}',
                    'published': published
                },
                success: function(data) {
                    if (data.status === 'success') {
                        var author = data.author;
                        var toggleButton = $('input[data-id="' + author.id + '"].toggle-class');
                        toggleButton.prop('checked', author.published == 1);
                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: ' status changed successfully',
                            icon: 'success',
                            timer: 2000,
                            timerProgressBar: true,
                            showConfirmButton: false
                        });
                    }
                }
            });
        });
    });
</script>


    <script>
        function ShowAlert(authorId) {
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
                    document.getElementById(`delete-form-${authorId}`).submit();
                }
            });
        }
    </script>
@endsection
