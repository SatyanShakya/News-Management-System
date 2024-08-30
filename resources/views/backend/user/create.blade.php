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
                        <ol class="breadcrumb float-sm-right">
                            <a href="{{ route('user.create') }}" class="btn btn-primary "  style="font-size: 18px; border-radius: 18px;">Create</a>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                <div class="row">

                    <section class="col-lg-12 connectedSortable">

                        <div class="card">

                            <div class="card-body">

                                {!! Form::open([
                                    'route'=>['user.store'],
                                    'method'=>'post',
                                    'enctype' => 'multipart/form-data'

                                    ]) !!}

                                @include('backend.user.form')

                                <div class="card-footer"  style="background-color: #fff;">
                                    {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('user.index') }}" class="btn btn-danger">Cancel</a>
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>

                </div>
        </section>

    </div>
@endsection

