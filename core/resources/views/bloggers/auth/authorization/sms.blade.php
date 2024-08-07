@extends('bloggers.layouts.master')

@section('content')
<div class="page-wrapper default-version">
    <div class="form-area bg_img" data-background="{{asset('assets/laramin/images/1.jpg')}}">
        <div class="form-wrapper">
            <div class="text-center mt-5">
                <h6>@lang('Please Verify Your Mobile to Get Access')</h6>
            </div>
            <form method="POST" action="{{ route('bloggers.verify.sms') }}" onsubmit="return submitUserForm();" class="cmn-form mt-30 account-form">
                @csrf
                <div class="form-group">
                    <p class="text-center">@lang('Your Mobile Number'): <strong>{{ auth()->guard('bloggers')->user()->mobile }}</strong></p>
                </div>

                <div class="form-group">
                    <label>@lang('Verification Code')</label>
                    <input type="text" name="sms_verified_code" class="form-control" placeholder="@lang('Enter verification code')" maxlength="7" id="code">
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="submit-btn mt-25">@lang('Submit')</button>
                </div>

                <div class="form-group">
                    <p>@lang('If you don\'t get any code'), <a href="{{ route('bloggers.send.verify.code') }}?type=phone" class="forget-pass"> @lang('Try again')</a></p>
                    @if($errors->has('resend'))
                    <br />
                    <small class="text-danger">{{ $errors->first('resend') }}</small>
                    @endif
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script>
    (function($) {
        "use strict";
        $('#code').on('input change', function() {
            var xx = document.getElementById('code').value;
            $(this).val(function(index, value) {
                value = value.substr(0, 7);
                return value.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
            });
        });
    })(jQuery)
</script>
@endpush