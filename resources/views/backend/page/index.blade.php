@extends('layouts.dashboard')

@section('content')
    {{-- create modal --}}
    <div class="modal fade" id="CreateFormModal" tabindex="-1" role="dialog" aria-labelledby="createFormModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="createFormModalLabel">Page Module</h2>
                    <span class="btn btn-close" id="cancelBtn"><i class="fas fa-times-circle"></i>
                    </span>

                </div>
                <div class="modal-body">
                    <ul id="save_msgList"></ul>
                    {!! Form::open(['route' => 'page.store', 'method' => 'post', 'id' => 'main_form']) !!}
                    @include('backend.page.form')
                    {{ Form::button('Create', ['id' => 'create_page', 'class' => 'btn btn-success']) }}
                    <button type="button" class="btn btn-danger btn-close" id="cancelBtn">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editFormModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFormModalLabel">Page Module</h5>
                    <span class="btn btn-close" id="cancelBtn"><i class="fas fa-times-circle"></i></span>
                </div>
                <div class="modal-body">
                    <ul id="update_msgList"></ul>
                    <input type="hidden" id="page_id" />

                    @include('backend.page.edit')
                    {{ Form::button('Update', ['id' => 'update_page', 'class' => 'btn btn-success update_page']) }}
                    <button type="button" class="btn btn-danger btn-close" id="cancelBtn">Cancel</button>
                </div>

            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> Page Module</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            @can('page-create')
                                <button type="button" class="btn btn-primary float-end" data-toggle="modal"
                                    data-target="#CreateFormModal" style="font-size: 18px; border-radius: 18px;">
                                    Create
                                </button>
                            @endcan
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <colgroup>
                                        <col style="width: 50px;">
                                        <col style="width: 200px;">
                                        <col style="width: 200px;">
                                        <col style="width: 100px;">
                                        <col style="width: 400px;">
                                        <col style="width: 400px;">
                                        @canany(['page-edit', 'page-delete'])
                                            <col style="width: 300px;">
                                        @endcanany
                                    </colgroup>
                                    <thead class="table-dark table-striped" style="font-size: 18px; ">
                                        <tr>
                                            <th class="text-center">S.N</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Slug</th>
                                            <th class="text-center">Published</th>
                                            <th class="text-center">Summary</th>
                                            <th class="text-center">Description</th>
                                            @canany(['page-edit', 'page-delete'])
                                                <th class="text-center">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                                <div style="display: flex; justify-content: space-between;">
                                    <div id="showing-links"></div>
                                    <div id="pagination-links"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
    </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            var serialNumber = 1;

            fetchpage();

            function fetchpage(page_url) { 
                serialNumber = 1;
                $.ajax({
                    type: "GET",
                    url: page_url || "/cms/fetch-page",
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        var currentPage = response.pages.current_page;
                        var totalItems = response.pages.total;
                        var itemsPerPage = response.pages.per_page;
                        var startItem = (currentPage - 1) * itemsPerPage + 1;
                        var endItem = Math.min(currentPage * itemsPerPage, totalItems);
                        $('tbody').html("");

                        if (response.pages.data.length == 0) {
                            $('tbody').append(
                                '<tr><td colspan="7" class="text-center" style="font-size: 24px; font-weight: bold;"> No Pages to show</td></tr>'
                            );
                        } else {
                            $.each(response.pages.data, function(key, item) {
                                var sn = serialNumber++;
                                var published = item.published == 1 ? 'checked' : '';
                                var summary = item.summary ? item.summary : '';
                                var description = item.description ? item.description : '';

                                summary = summary.length > 150 ? summary.substr(0, 150) +
                                    '...' : summary;
                                description = description.length > 150 ? description.substr(0,
                                    150) + '...' : description;

                                $('tbody').append('<tr>\
                                        <td>' + sn + '</td>\
                                        <td>' + item.title + '</td>\
                                        <td>' + item.slug + '</td>\
                                        <td>\
                                            @can('page-edit')\
                                            <input type="checkbox" data-id="' + item.id +
                                    '" class="toggle-class" data-toggle="toggle" data-on="ON" data-off="OFF" ' +
                                    published + '>\
                                            @else\
                                            <input type="checkbox" data-id="' + item.id +
                                    '" class="toggle-class" data-toggle="toggle" data-on="ON" data-off="OFF" ' +
                                    published + ' disabled >\
                                            @endcan\
                                        </td>\
                                        <td>' + summary + '</td>\
                                        <td>' + description + '</td>\
                                        @canany(['page-edit', 'page-delete'])\
                                        <td class="text-center">\
                                          @can('page-edit')\
                                          <button type="button" value="' + item.id + '" class="btn btn-primary editbtn " style="width: 80px; "> Edit </button>\
                                          @endcan\
                                          @can('page-delete')\
                                          <button type="button" value="' + item.id + '" class="btn btn-danger deletebtn  delete_page_btn" style="width: 80px; ">Delete</button>\
                                          @endcan\
                                        </td>\
                                        @endcanany\
                                    </tr>');
                            });
                        }

                        // Update pagination links
                        $('#pagination-links').html(response.pagination);

                        // For toogle
                        $('.toggle-class').bootstrapToggle();

                        //showing ko message
                        $('#showing-links').html(
                            `Showing ${startItem} to ${endItem} of ${totalItems} results`);

                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                    }
                });
            }

            // pagination link
            $(document).on('click', '#pagination-links a', function(e) {
                e.preventDefault();
                var page_url = $(this).attr('href');
                fetchpage(page_url);
            });

            function resetFormFields() {
                $('#main_form')[0].reset();
            }

            // create
            $(document).on('click', '#create_page', function(e) {
                e.preventDefault();

                var data = {
                    'title': $('.title').val(),
                    'slug': $('.slug').val(),
                    'published': $('#published').is(':checked') ? 1 : 0,
                    'summary': $('.summary').val(),
                    'description': tinymce.get('description').getContent(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/cms/page",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $.each(response.errors, function(key,
                                err_value) {
                                // '#' + key + '-error': Constructs the ID selector for the <span> element associated with the form field. For example, if key is 'title', the selector becomes '#title-error'.
                                var errorElement = $('#' + key + '-error').text(
                                    err_value).addClass('text-danger');

                                setTimeout(function() {
                                    errorElement.text('').removeClass(
                                        'text-danger');
                                }, 4000);

                            });

                        } else {
                            $('#save_msgList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#CreatePageModal').find('input').val('');
                            $('.create_page').text('create');
                            $('#CreateFormModal').modal('hide');

                            fetchpage();

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            resetFormFields();
                        }
                    }
                });
            });
            $('#CreateFormModal').on('hidden.bs.modal', function() {
                $(this).find('form').trigger('reset');
                $(this).find('.text-danger').text('').removeClass('text-danger');
                $('#success_message').removeClass('alert alert-success').text('');
                tinymce.get('description').setContent('');
            });

            // edit

            $(document).on('click', '.editbtn', function(e) {
                e.preventDefault();
                var page_id = $(this).val();
                $('#page_id').val(page_id);


                $('#editModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/cms/edit-page/" + page_id,
                    success: function(response) {
                        if (response.status == 404) {

                        } else {
                            if (response.page.published == 1) { //if publised is on
                                $('#titleedit').val(response.page.title);
                                $('#slugedit').val(response.page.slug);
                                $('#publishededit').bootstrapToggle('on');
                                $('#summaryedit').val(response.page.summary);
                                tinymce.get('descriptionedit').setContent(response.page
                                    .description);
                            } else { //if published is off
                                $('#titleedit').val(response.page.title);
                                $('#slugedit').val(response.page.slug);
                                $('#publishededit').bootstrapToggle('off');
                                $('#summaryedit').val(response.page.summary);
                                tinymce.get('descriptionedit').setContent(response.page
                                    .description);
                            }
                        }
                    }
                });
                $('.btn-close').find('input').val('');
            });

            //update

            $(document).on('click', '.update_page', function(e) {
                e.preventDefault();
                var id = $('#page_id').val();

                var data = {
                    'title': $('#titleedit').val(),
                    'slug': $('#slugedit').val(),

                    'published': $('#publishededit').is(':checked') ? 1 : 0,
                    'summary': $('#summaryedit').val(),
                    'description': tinymce.get('descriptionedit').getContent()
                };

                if (!$('#publishededit').is(':checked')) {
                    data.published = 0;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "PUT",
                    url: "/cms/update-page/" + id,
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if (response.status == 400) {
                            $.each(response.errors, function(key,
                                err_value) { //(name of form field ,error msg)
                                // '#' + key + '-error': Constructs the ID selector for the <span> element associated with the form field. For example, if key is 'title', the selector becomes '#title-error'.
                                var errorElement = $('#' + key + 'edit' + '-error')
                                    .text(err_value).addClass('text-danger');
                                setTimeout(function() {
                                    errorElement.text('').removeClass(
                                        'text-danger');
                                }, 4000);
                            });
                        } else {
                            $('#update_msgList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#editModal').modal('hide');
                            fetchpage();

                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });

                            resetFormFields();
                        }
                    }
                });
            });

            //delete

            $(document).on('click', '.delete_page_btn', function() {
                var page_id = $(this).val();

                console.log(page_id);
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
                        $.ajax({
                            type: "DELETE",
                            url: "/cms/delete-page/" + page_id,
                            dataType: "json",
                            data: {
                                _method: 'DELETE',
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.status == 404) {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message,
                                        icon: 'error'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.message,
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        fetchpage();
                                    });

                                }
                            }
                        });
                    }
                });
            });


            // cancel

            $(document).on('click', '#cancelBtn', function(e) {
                e.preventDefault();

                // Clear form fields
                $('#main_form')[0].reset();

                // Close create modal
                $('#CreateFormModal').modal('hide');

                // Close edit modal
                $('#editModal').modal('hide');

            });
        });
    </script>

    <script>
        //change toogle value
        $(document).ready(function() {

            $(document).on('change', '.toggle-class', function() {
                var pageId = $(this).data('id');
                var published = $(this).prop('checked') ? 1 : 0;
                var url = "/cms/page/toggle/" + pageId;

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
                            var page = data.page;
                            var toggleButton = $('input[data-id="' + page.id +
                                '"].toggle-class');
                            toggleButton.prop('checked', page.published == 1);

                            Swal.fire({
                                title: 'Success!',
                                text: 'Page status changed successfully',
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
@endsection
