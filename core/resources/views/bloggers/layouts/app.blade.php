@extends('bloggers.layouts.master')

@section('content')
    <!-- page-wrapper start -->
    <div class="page-wrapper default-version">
        @include('bloggers.partials.sidenav')
        @include('bloggers.partials.topnav')

        <div class="body-wrapper">
            <div class="bodywrapper__inner">

                @include('bloggers.partials.breadcrumb')

                @yield('panel')


            </div><!-- bodywrapper__inner end -->
        </div><!-- body-wrapper end -->
    </div>
@endsection

@push('style')
    <style>
     @media (max-width: 991px) {
        .fullscreen-btn{
            display: none;
        }
    }
    </style>
@endpush
