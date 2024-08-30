@extends('layouts.frontend')
@section('content')
    <!-- Breadcrumb -->
    <div class="container">
        <div class="bg0 flex-wr-sb-c p-rl-20 p-tb-8">
            <div class="f2-s-1 p-r-30 m-tb-6">
                <span class="breadcrumb-item f1-s-3 cl9">
                    Home
                </span>
                <span class="breadcrumb-item f1-s-3 cl9">
                    Contact
                </span>
            </div>
            <form action="{{ route('frontend.search') }}" method="GET">
                <div class="pos-relative size-a-2 bo-1-rad-22 of-hidden bocl11 m-tb-6">
                    <input class="f1-s-1 cl6 plh9 s-full p-l-25 p-r-45" type="text" name="keyword" placeholder="Search"
                        value="{{ request()->query('keyword') }}">
                    <button type="submit" class="flex-c-c size-a-1 ab-t-r fs-20 cl2 hov-cl10 trans-03">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Page heading -->
    <div class="container p-t-4 p-b-40">
        <h2 class="f1-l-1 cl2">
            Contact
        </h2>
    </div>

    <!-- Content -->
    <section class="bg0 p-b-60">
        <div class="container">
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
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-12 p-b-80">
                    <div class="p-r-10 p-r-0-sr991">
                        <form action="{{ route('frontend.contactus') }}" method="post" id="contactForm">
                            @csrf

                            <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-5" type="text"
                                name="name" placeholder="Name*" value="{{ old('name') }}">
                            <span class="text-danger" id="name-error"></span>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                            </br>

                            <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-5" type="text"
                                name="email" placeholder="Email*" value="{{ old('email') }}">
                            <span class="text-danger" id="email-error"></span>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                            <br>

                            <input class="bo-1-rad-3 bocl13 size-a-19 f1-s-13 cl5 plh6 p-rl-18 m-b-5" type="text"
                                name="address" placeholder="Address*" value="{{ old('address') }}">
                            <span class="text-danger" id="address-error"></span>
                            @if ($errors->has('address'))
                                <span class="text-danger">{{ $errors->first('address') }}</span>
                            @endif
                            <br>

                            <textarea class="bo-1-rad-3 bocl13 size-a-15 f1-s-13 cl5 plh6 p-rl-18 p-tb-14 m-b-5" name="message"
                                placeholder="Your Message*">{{ old('message') }}</textarea>
                            <span class="text-danger" id="message-error"></span>
                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                            <br>

                            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                            <span class="text-danger" id="recaptcha_token-error"></span>
                            @if ($errors->has('recaptcha_token'))
                                <span class="text-danger">{{ $errors->first('recaptcha_token') }}</span>
                            @endif
                            <br>


                            <button type="submit"
                                class="size-a-20 bg2 borad-3 f1-s-12 cl0 trans-03 p-rl-15 m-t-20">
                                Send
                                <div class="spinner-border spinner-border-sm text-light d-none" role="status" id="loader">
                                    <span class="sr-only"></span>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#contactForm').submit(function(event) {
                event.preventDefault();

                // Show loader
                $('#loader').removeClass('d-none');

                // Verify recaptcha
                grecaptcha.ready(function() {
                    grecaptcha.execute('{{ config('services.recaptcha.key') }}', {
                        action: 'submit'
                    }).then(function(token) {
                        // Append the recaptcha
                        $('#recaptcha_token').val(token);

                        var $form = $('#contactForm');
                        var formData = $form.serialize();

                        $.ajax({
                            url: $form.attr('action'),
                            type: 'POST',
                            data: formData,
                            success: function(response) {
                                //error message remove garxa after submit
                                $('#name-error').text('');
                                $('#email-error').text('');
                                $('#address-error').text('');
                                $('#message-error').text('');
                                $('#recaptcha_token-error').text('');

                                // Hide loader
                                $('#loader').addClass('d-none');

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.success,
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                $form[0].reset();

                            },
                            error: function(response) {
                                // // Hide loader
                                $('#loader').addClass('d-none');

                                var errors = response.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    $('#' + key + '-error').text(value)
                                        .show();
                                });
                            }
                        });
                    });
                });
            });

            // Hide error message
            $('#contactForm input, #contactForm textarea').keyup(function() {
                $(this).siblings('.text-danger').hide();
            });
        });
    </script>
@endsection
