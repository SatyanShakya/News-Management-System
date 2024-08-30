<span class="text-danger" id="recaptcha_token-error"></span>
@if ($errors->has('recaptcha_token'))
    <span class="text-danger">{{ $errors->first('recaptcha_token') }}</span>
@endif
<br>



<div class="spinner-border text-primary d-none" role="status" id="loader">
    <span class="sr-only"></span>
</div>
