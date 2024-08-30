@extends('layouts.dashboard')

@section('content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">User Module</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('user-create')

                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('user.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>

                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($users->isEmpty())
                    <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                            No Users to show.
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

                                <table class="table table-bordered">
                                    <colgroup>
                                        <col style="width: 50px;">
                                        <col style="width: 100px;">
                                        <col style="width: 300px;">
                                        <col style="width: 150px;">
                                        <col style="width: 100px;">
                                        <col style="width: 90px;">

                                        @canany(['user-edit', 'user-delete'])
                                        <col style="width: 100px;">
                                        @endcanany

                                    </colgroup>
                                    <thead class="table-dark table-striped" style="font-size: 18px;">
                                        <tr>
                                            <th scope="col" class="text-center">S.N</th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Email</th>
                                            <th scope="col" class="text-center">Roles</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Image</th>
                                            @canany(['user-edit', 'user-delete'])
                                            <th scope="col" class="text-center">Action</th>
                                            @endcanany

                                        </tr>
                                    </thead>
                                    @foreach ($users as $user)

                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $loop->index + 1 }}</td> {{-- for S.n --}}
                                                <td class="text-center">{{ $user->name }}</td>
                                                <td class="text-center">{{ $user->email }}</td>
                                                <td>
                                                    @foreach ($user->roles as $role)
                                                    <span class="badge badge-success m-1" style="font-size:15px">{{ $role->name }}</span>
                                                    @endforeach
                                                </td>
                                                <td class="text-center">
                                                    @can('user-edit')
                                                    <input type="checkbox" data-id="{{ $user->id }}"
                                                        data-toggle="toggle" name="published" class="toggle-class"
                                                        data-on="Active" data-off="Inactive"
                                                        {{ $user->published == '1' ? 'checked' : '' }}>
                                                        @else
                                                        <input type="checkbox" data-id="{{ $user->id }}"
                                                            data-toggle="toggle" name="published" class="toggle-class"
                                                            data-on="Active" data-off="Inactive"
                                                            {{ $user->published == '1' ? 'checked' : '' }} disabled>
                                                    @endcan
                                                </td>

                                                <td class="text-center">
                                                @if ($user->image)

                                                        <img src="{{ asset('/images/user/' . $user->image) }}"
                                                            alt="Image" class="rounded-circle" alt="Image" style="max-width: 100px;">

                                                @else

                                                        <img src="{{ asset('images/user/default.jpg') }}" alt="Image"
                                                        class="rounded-circle" alt="Image" style="max-width: 100px;">

                                                @endif
                                                </td>
                                            @canany(['user-edit', 'user-delete'])

                                                <td class="text-center">
                                                    <div class="d-flex justify-content-center">
                                                        @can('user-edit')

                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-primary mr-2" style="width: 80px;">Edit</a>

                                                        @endcan

                                                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" id="delete-form-{{ $user->id }}"  onsubmit="return false; ">
                                                                @csrf
                                                                @method('DELETE')
                                                                @can('user-delete')
                                                                <button type="button" onclick="ShowAlert({{ $user->id }})" class="btn btn-danger" style="width: 80px;">Delete</button>
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
                                        Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} results
                                    </div>

                                    <div>
                                        {{ $users->links() }}
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
    $(document).ready(function() {
        $('.toggle-class').change(function() {
            var userId = $(this).data('id');
            var published = $(this).prop('checked') ? 1 : 0;
            var url = "/cms/user/toggle/" + userId;

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
                        var user = data.user;
                        var toggleButton = $('input[data-id="' + user.id + '"].toggle-class');
                        toggleButton.prop('checked', user.published == 1);

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
        function ShowAlert(userId) {
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
                    document.getElementById(`delete-form-${userId}`).submit();
                }
            });
        }
    </script>
@endsection
