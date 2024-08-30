@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permission Module</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($permissions->isEmpty())
                    <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                        No Permissions to show
                    </div>
                @else
                    <div class="row">

                        <section class="col-lg-12 connectedSortable">

                            <div class="card">

                                <div class="card-body">

                                    <table class="table table-bordered">
                                        <colgroup>
                                            <col style="width: 50px;">
                                            <col style="width: 300px;">
                                            <col style="width: 300px;">

                                        </colgroup>
                                        <thead class="table-dark table-striped" style="font-size: 18px;">
                                            <tr>
                                                <th scope="col" class="text-center">S.N</th>
                                                <th scope="col" class="text-center">Name</th>
                                                <th scope="col" class="text-center">Slug</th>
                                            </tr>
                                        </thead>
                                        @foreach ($permissions as $permission)

                                            <tbody>
                                                <tr>
                                                    <td class="text-center">{{ $loop->index + 1 }}</td> {{-- for S.n --}}
                                                    <td class="text-center">{{ $permission->name }}</td>
                                                    <td class="text-center">{{ $permission->slug }}</td>

                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>

                                    {{-- Pagination --}}
                                    {{-- <div style="display: flex; justify-content: space-between;">
                                        <div>
                                            Showing {{ $permissions->firstItem() }} to {{ $permissions->lastItem() }} of
                                            {{ $permissions->total() }} results
                                        </div>

                                        <div>
                                            {{ $permissions->links() }}
                                        </div>
                                    </div> --}}


                                </div>
                            </div>

                @endif
            </div>
        </section>

    </div>
@endsection
