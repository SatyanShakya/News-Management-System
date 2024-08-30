@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Role Module</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('role-create')

                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('role.create') }}" class="btn btn-primary "
                                style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>

                        @endcan
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($roles->isEmpty())
                    <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                        No Roles to show
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
                                                text: "{{ session('success') }}",
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
                                            <col style="width: 300px;">
                                            <col style="width: 300px;">
                                            <col style="width: 300px;">
                                            @canany(['role-edit', 'role-delete'])
                                            <col style="width: 300px;">
                                            @endcanany
                                        </colgroup>
                                        <thead class="table-dark table-striped" style="font-size: 18px;">
                                            <tr>
                                                <th scope="col" class="text-center">S.N</th>
                                                <th scope="col" class="text-center">Name</th>
                                                <th scope="col" class="text-center">Slug</th>
                                                <th scope="col" class="text-center">Permissions</th>
                                            @canany(['role-edit', 'role-delete'])
                                                <th scope="col" class="text-center">Action</th>
                                            @endcanany
                                            </tr>
                                        </thead>
                                        @foreach ($roles as $role)

                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{ $loop->index + 1 }}</td> {{-- for S.n --}}
                                                    <td class="text-center">{{ $role->name }}</td>
                                                    <td class="text-center">{{ $role->slug }}</td>
                                                    <td>
                                                            @foreach ($role->permissions as $permission)
                                                            <span class="badge badge-success m-1" style="font-size:15px">{{ $permission->name }}</span>
                                                            @endforeach
                                                    </td>

                                            @canany(['role-edit', 'role-delete'])

                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center">
                                                            @can('role-edit')

                                                            <a href="{{ route('role.edit', $role->id) }}"
                                                                class="btn btn-primary mr-2" style="width: 80px;">Edit</a>

                                                            @endcan
                                                            <form id="delete-form-{{ $role->id }}" action="{{ route('role.destroy', $role->id) }}"
                                                                method="POST" onsubmit="return false;">
                                                                @csrf
                                                                @method('DELETE')
                                                                @can('role-delete')

                                                                <button type="button"
                                                                    onclick="ShowAlert({{ $role->id }})"
                                                                    class="btn btn-danger"
                                                                    style="width: 80px;">Delete</button>

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
                                            Showing {{ $roles->firstItem() }} to {{ $roles->lastItem() }} of
                                            {{ $roles->total() }} results
                                        </div>

                                        <div>
                                            {{ $roles->links() }}
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


    {{-- sweet alert --}}
    <script>
        function ShowAlert(roleId) {
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
                    document.getElementById(`delete-form-${roleId}`).submit();
                }
            });
        }
    </script>
@endsection

