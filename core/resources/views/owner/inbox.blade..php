@extends('owner.layouts.app')

@section('panel')

    Inbox
@endsection

@push('breadcrumb-plugins')
    <a href="{{ route('owner.change.password') }}" class="btn btn-sm btn--primary box--shadow1 text--small" ><i class="fa fa-key"></i>@lang('Change Password')</a>
@endpush
