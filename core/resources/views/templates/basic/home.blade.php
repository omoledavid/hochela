@extends($activeTemplate.'layouts.frontend')
@section('content')
    @php
        $bannerElement = getContent('banner.element');
    @endphp
        <!-- hero section start -->
    <section class="banner-section my-4">
        <div class="container-fluid">
            <div class="banner__wrapper">
                <div class="banner__wrapper-category d-none d-lg-block">
                    <div class="banner__wrapper-category-inner">
                    </div>
                </div>
                <div class="banner__wrapper-content">
                    <div class="banner-slider owl-theme owl-carousel">
                        @foreach ($bannerElement as $banner)
                            <div class="banner__wrapper-content-inner">
                                <a href="{{ $banner->data_values->url }}">
                                    <img src="{{ frontendImage('banner', $banner->data_values->image, '1290x480') }}"
                                         alt="banner">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero section end -->
    <!-- search section start -->
    <section id="hero_img" class="hero">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-10 mt-1 wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.7s">
                    <div class="hero-search-area rounded-3">
                        <form action="{{ route('property.search') }}" class="hero-search-form">
                            <div class="row gy-3 align-items-center">
                                <div class="col-xl-4 col-lg-4 col-sm-6">
                                    <label>@lang('House Type')</label>
                                    <div class="input-group border px-2 radius-5">
                                        <span class="input-group-text"><i class="las la-calendar-check"></i></span>
                                        <select class="select2-basic" name="propertyType" id="propertyType">
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($propertyTypes as $propertyType)
                                                <option value="{{ $propertyType->id }}"
                                                        @if(old('propertyType')==$propertyType->id) selected="selected" @endif>{{ __($propertyType->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-6">
                                    <label>@lang('Budget')</label>
                                    <div class="input-group border px-2 radius-5">
                                        <input type="text" name="adult" placeholder="50,000 - 250,000"
                                               autocomplete="off" min="1" id="adult" class="form--control">
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-sm-6">
                                    <label>@lang('Location')</label>
                                    <div class="input-group border px-2 radius-5">
                                        <span class="input-group-text"><i class="las la-map-marker"></i></span>
                                        <select class="select2-basic" name="location" id="location">
                                            <option value="">@lang('Select One')</option>
                                            @foreach ($locations as $location)
                                                <option value="{{ $location->id }}"
                                                        @if(old('location')==$location->id) selected="selected" @endif>{{ __($location->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 text-end align-self-end">
                                    <button type="submit" class="btn btn--base w-100">@lang('Search')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero section end -->

    {{--ads section--}}



    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif
@endsection
