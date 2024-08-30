@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SEO</h1>
                    </div>
                    <div class="col-sm-6">
                        @can('seo-create')
                            <ol class="breadcrumb float-sm-right">
                                <a href="{{ route('fields.create') }}" class="btn btn-primary"
                                    style="font-size: 18px; border-radius: 18px;">Add/Edit</a>
                            </ol>
                        @elsecan('seo-edit')
                            <ol class="breadcrumb float-sm-right">
                                <a href="{{ route('fields.create') }}" class="btn btn-primary"
                                    style="font-size: 18px; border-radius: 18px;">Add/Edit</a>
                            </ol>
                        @endcan

                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">

                @if ($fields->isEmpty())
                    <div class="badge text-bg-primary text-wrap" style="width: 90rem; font-size: 24px;">
                        No Fields to show
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

                                    <form action="{{ route('fields.store.value') }}" method="POST">
                                        @csrf
                                        @foreach ($fields as $field)
                                            <div class="form-group">
                                                <label class="form-label"> {{ $field->label }}</label>
                                                <input type="hidden" name="field_ids[]" value="{{ $field->id }}">
                                                @if ($field->type === 'text')
                                                    <input type="text" name="values[]" class="form-control"
                                                        value="{{ $field->value }}">
                                                @elseif ($field->type === 'textarea')
                                                    <textarea name="values[]" class="form-control" rows="6">{{ $field->value }}</textarea>
                                                @else
                                                    <input type="number" name=values[] class="form-control"
                                                        value="{{ $field->value }}">
                                                @endif
                                            </div>
                                        @endforeach

                                        <br>
                                        @can('seo-edit')
                                            <button type="submit" class="btn btn-success">Update</button>
                                        @endcan
                                    </form>
                                </div>
                            </div>
                        </section>
                    </div>
                @endif

        </section>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            // Handle delete button click
            $(document).on('click', '.delete-button', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
