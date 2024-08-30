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
                        @can('category-create')

                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('category.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>

                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                @if ($categories->isEmpty())
                <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                    No Categories to show
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
                                        timer: 2000 s
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
                                        <col style="width: 100px;">
                                        <col style="width: 300px;">
                                        <col style="width: 100px;">
                                        @canany(['category-edit', 'category-delete'])
                                        <col style="width: 100px;">
                                        @endcanany
                                    </colgroup>
                                    <thead class="table-dark table-striped" style="font-size: 18px;">
                                        <tr>
                                            <th scope="col"  class="text-center">S.N</th>
                                            <th scope="col"  class="text-center">Name </th>
                                            <th scope="col"  class="text-center">Slug </th>
                                            <th scope="col"  class="text-center">Description </th>
                                            <th scope="col"  class="text-center">Published</th>
                                        @canany(['category-edit', 'category-delete'])
                                            <th scope="col"  class="text-center">Action</th>
                                        @endcanany

                                        </tr>
                                    </thead>
                                    @foreach ($categories as $category)
                                        <tbody>
                                            <tr>
                                                <td>{{ $loop->index + 1 }}</td> {{-- for S.n --}}
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    @if (strlen($category->description) > 150)
                                                        {!! substr($category->description, 0, 150) !!}...
                                                    @else
                                                        {!! $category->description !!}
                                                    @endif
                                                </td>

                                                <td>
                                                    @can('category-edit')
                                                    <input type="checkbox" data-id="{{ $category->id }}"
                                                        data-toggle="toggle" name="published" class="toggle-class"
                                                        data-on="ON" data-off="OFF"
                                                        {{ $category->published == '1' ? 'checked' : '' }}>
                                                    @else
                                                    <input type="checkbox" data-id="{{ $category->id }}"
                                                    data-toggle="toggle" name="published" class="toggle-class"
                                                    data-on="ON" data-off="OFF"
                                                    {{ $category->published == '1' ? 'checked' : '' }} disabled>
                                                    @endcan
                                                </td>

                                        @canany(['category-edit', 'category-delete'])

                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        @can('category-edit')

                                                        <a href="{{ route('category.edit', $category->id) }}"
                                                            class="btn btn-primary mr-2" style="width: 80px;">
                                                            Edit
                                                        </a>

                                                        @endcan

                                                        <form action="{{ route('category.destroy', $category->id) }}"
                                                            method="post" id="delete-form-category-{{ $category->id }}" onsubmit="return false;">
                                                            @csrf
                                                            @method('DELETE')
                                                            @can('category-delete')

                                                            <button class="btn btn-danger" style="width: 80px;" onclick="ShowAlert({{ $category->id }})">Delete</button>

                                                            @endcan
                                                        </form>
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
                                        Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} results
                                    </div>

                                    <div>
                                        {{ $categories->links() }}
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

{{-- change toogle --}}
<script>
    $(document).ready(function() {
        $('.toggle-class').change(function() {
            var categoryId = $(this).data('id');
            var published = $(this).prop('checked') ? 1 : 0;
            var url = "/cms/category/toggle/" + categoryId;

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
                        var category = data.category;
                        var toggleButton = $('input[data-id="' + category.id + '"].toggle-class');
                        toggleButton.prop('checked', category.published == 1);

                        // Show success message
                        Swal.fire({
                            title: 'Success!',
                            text: 'Category status changed successfully',
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


{{-- sweet alert --}}
        <script>
        function ShowAlert(categoryId) {
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
                    document.getElementById(`delete-form-category-${categoryId}`).submit();
                }
            });
        }
    </script>


@endsection
