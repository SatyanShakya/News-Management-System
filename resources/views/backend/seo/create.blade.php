@extends('layouts.dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">SEO</h1>
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
                                <form action="{{ route('fields.store') }}" method="POST">
                                    @csrf
                                    <table id="fields-table" class="table table-bordered">
                                        <colgroup>
                                            <col style="width: 300px;">
                                            <col style="width: 300px;">
                                            <col style="width: 300px;">
                                            <col style="width: 90px;">
                                        </colgroup>
                                        <thead class="table-dark table-striped" style="font-size: 18px;">
                                            <tr>
                                                <th scope="col" class="text-center">Input type</th>
                                                <th scope="col" class="text-center">Label</th>
                                                <th scope="col" class="text-center">Field Name</th>
                                                <th scope="col" class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="fields-body">
                                            @if (Gate::check('seo-edit'))
                                                @foreach ($fields as $field)
                                                    <tr>
                                                        <td>
                                                            {{-- loop-index le unique index generate garxa for each input field for update --}}
                                                            <select class="form-control"
                                                                name="fields[{{ $loop->index }}][type]">
                                                                <option value="text"
                                                                    {{ $field->type == 'text' ? 'selected' : '' }}>Text
                                                                </option>
                                                                <option value="textarea"
                                                                    {{ $field->type == 'textarea' ? 'selected' : '' }}>
                                                                    Textarea
                                                                </option>
                                                                <option value="number"
                                                                    {{ $field->type == 'number' ? 'selected' : '' }}>Number
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control field-input"
                                                                name="fields[{{ $loop->index }}][label]"
                                                                value="{{ $field->label }}">
                                                            <span class="text-danger label-error"></span>
                                                            @error('fields.' . $loop->index . '.label')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control fieldname-input"
                                                                name="fields[{{ $loop->index }}][field_name]"
                                                                value="{{ $field->field_name }}">
                                                            <span class="text-danger label-error"></span>
                                                            @error('fields.' . $loop->index . '.field_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="hidden" name="fields[{{ $loop->index }}][id]"
                                                                value="{{ $field->id }}">
                                                            @can('seo-delete')
                                                                <span class="deletebtn btn btn-danger"
                                                                    data-field-id="{{ $field->id }}">
                                                                    <i class="fas fa-trash fa-2x"></i>
                                                                </span>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                @foreach ($fields as $field)
                                                    <tr>
                                                        <td>
                                                            {{-- loop-index le unique index generate garxa for each input field for update --}}
                                                            <select class="form-control" disabled>
                                                                <option value="text"
                                                                    {{ $field->type == 'text' ? 'selected' : '' }}>Text
                                                                </option>
                                                                <option value="textarea"
                                                                    {{ $field->type == 'textarea' ? 'selected' : '' }}>
                                                                    Textarea
                                                                </option>
                                                                <option value="number"
                                                                    {{ $field->type == 'number' ? 'selected' : '' }}>Number
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                value="{{ $field->label }}" readonly>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control"
                                                                value="{{ $field->field_name }}" readonly>

                                                        </td>
                                                        <td class="text-center">
                                                            @can('seo-delete')
                                                                <span class="deletebtn btn btn-danger"
                                                                    data-field-id="{{ $field->id }}">
                                                                    <i class="fas fa-trash fa-2x"></i>
                                                                </span>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>

                                    </table>
                                    <div class="d-flex justify-content-between mt-3">
                                        @can('seo-create')
                                            <button type="button" id="add-button" class="btn btn-primary">Add item <i
                                                    class="fas fa-plus"></i></button>
                                        @endcan
                                        <div>
                                            <button type="submit" class="btn btn-success">Update</button>
                                            <a href="{{ route('fields.index') }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var fieldIndex = {{ $fields->count() }};

            $('#add-button').click(function() {
                $('#fields-body').append(`
            <tr>
                <td>
                    <select class="form-control" name="fields[${fieldIndex}][type]">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="number">Number</option>
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control field-input" name="fields[${fieldIndex}][label]">
                    <span class="text-danger label-error"> </span>
                </td>
                <td>
                    <input type="text" class="form-control fieldname-input" name="fields[${fieldIndex}][field_name]">
                    <span class="text-danger label-error"> </span>
                </td>
                <td class="text-center">
                    <span class="delete-button btn btn-danger"><i class="fas fa-trash fa-2x"></i></span>
                </td>
            </tr>
        `);
                fieldIndex++;
            });

            // Delete for adding field
            $(document).on('click', '.delete-button', function() {
                $(this).closest('tr').remove();
            });

            // Delete for data
            $(document).on('click', '.deletebtn', function() {
                var row = $(this).closest('tr');
                var fieldId = $(this).data('field-id');
                var token = '{{ csrf_token() }}';

                $.ajax({
                    url: 'delete-fields/' + fieldId,
                    type: 'DELETE',
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        row.remove();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            // Slug
            $(document).on('keyup', '.field-input', function() {
                var $row = $(this).closest('tr');
                var text = $(this).val().toLowerCase().replace(/\s+/g, '-');
                $row.find('.fieldname-input').val(text);
            });


            //validation
            $('form').submit(function(event) {
                var valid = true;
                var fieldNames = {};

                $('.field-input, .fieldname-input').each(function() {
                    var $input = $(this);
                    var value = $input.val();

                    if (value == '') {
                        $input.next('.label-error').text('This field is required');
                        valid = false;
                    } else if ($input.hasClass('fieldname-input')) {
                        if (fieldNames[value]) {
                            $input.next('.label-error').text('Field name must be unique');
                            valid = false;
                        } else {
                            fieldNames[value] = true;
                            $input.next('.label-error').text('');
                        }
                    } else {
                        $input.next('.label-error').text('');
                    }
                });

                if (!valid) {
                    event.preventDefault();
                }
            });


        });
    </script>
@endsection
