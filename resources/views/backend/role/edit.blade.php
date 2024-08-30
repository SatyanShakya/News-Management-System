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
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('role.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
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

                                {!! Form::model($role,[
                                    'route' => ['role.update', $role->id],
                                    'method' => 'post',
                                ]) !!}

                                @method('PUT')
                                @include('backend.role.form')

                                <div class="card-footer"  style="background-color: #fff;">
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('role.index') }}" class="btn btn-danger">Cancel</a>
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                </div>
        </section>
    </div>
@endsection
