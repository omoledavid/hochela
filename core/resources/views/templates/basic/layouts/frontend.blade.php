<!doctype html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->sitename(__($pageTitle)) }}</title>

    @include('partials.seo')
    <!-- Bootstrap CSS -->
    <link rel="icon" type="image/png" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
          sizes="16x16">
    <link rel="icon" type="image/png" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
          sizes="180x180">
    <link rel="apple-touch-icon" type="image/png"
          href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}"
          sizes="180x180">
    <!-- bootstrap 5  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/bootstrap.min.css') }}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <!-- lineawesome font -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">
    <!--  -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lightcase.css') }}">
    <!-- slick slider css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/lib/slick.css') }}">
    <!-- select 2 plugin css -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <!-- dateoicker css -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/datepicker.min.css') }}">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/bootstrap-fileinput.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/color.php') }}?color={{ $general->base_color }}">

    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/slick.css') }}">

    {{--    feedback--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    @stack('style-lib')

    @stack('style')
    <x-facebook_pixel/>
    <!-- Include Mixpanel JS SDK in the <head> of your layout -->
    <x-mixpanel/>

    <style>
        #starRating .fa-star {
            font-size: 1.5rem;
            color: #ddd; /* Default color */
            cursor: pointer;
            margin-right: 0.2rem;
        }

        #starRating .fa-star.selected {
            color: #ffc107; /* Highlighted color */
        }
    </style>

</head>

<body>

@stack('fbComment')

@include($activeTemplate . 'partials.preloader')
<!-- header-section start  -->
@include($activeTemplate . 'partials.header')

<div class="main-wrapper">
    @if (
        !request()->routeIs('home') &&
            !request()->routeIs('property.details') &&
            !request()->routeIs('property') &&
            !request()->routeIs('property.category.rooms') &&
            !request()->routeIs('property.category.rooms.date'))
        @include($activeTemplate . 'partials.breadcrumb')
    @endif

    @yield('content')

</div><!-- main-wrapper end -->


<!-- footer section start -->
@include($activeTemplate . 'partials.footer')

@include($activeTemplate . 'partials.go_to_top')

@php
    $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
@endphp

@if (@$cookie->data_values->status && !session('cookie_accepted'))
    <!-- cookies dark version start -->
    <div class="cookies-card bg--default text-center cookies--dark radius--10px">
        <div class="cookies-card__icon">
            <i class="fas fa-cookie-bite"></i>
        </div>
        <p class="mt-4 cookies-card__content"> @php echo @$cookie->data_values->description @endphp <a class="d-inline"
                                                                                                       href="{{ @$cookie->data_values->link }}">@lang('Read Policy')</a>
        </p>
        <div class="cookies-card__btn mt-4">
            <a href="{{ route('cookie.accept') }}" class="cookies-btn btn--base">Allow</a>
        </div>
    </div>
    <!-- cookies default end -->
@endif

@stack('modal')

<!-- Feedback Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">We value your feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="feedbackForm">
                    <!-- Star Rating -->
                    <div class="form-group">
                        <label for="rating">Rate us:</label>
                        <div id="starRating" class="d-flex">
                            <!-- Star icons (Font Awesome) -->
                            <span class="fa fa-star" data-rating="1"></span>
                            <span class="fa fa-star" data-rating="2"></span>
                            <span class="fa fa-star" data-rating="3"></span>
                            <span class="fa fa-star" data-rating="4"></span>
                            <span class="fa fa-star" data-rating="5"></span>
                        </div>
                    </div>

                    <!-- Feedback Text -->
                    <div class="form-group">
                        <label for="feedbackText">Your feedback:</label>
                        <textarea class="form-control" id="feedbackText" rows="3"
                                  placeholder="Write your feedback here..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitFeedback">Submit Feedback</button>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset($activeTemplateTrue . 'js/lib/bootstrap.bundle.min.js') }}"></script>
<!-- slick slider js -->
<script src="{{ asset($activeTemplateTrue . 'js/lib/slick.min.js') }}"></script>
<!-- scroll animation -->
<script src="{{ asset($activeTemplateTrue . 'js/lib/wow.min.js') }}"></script>
<!-- lightcase js -->
<script src="{{ asset($activeTemplateTrue . 'js/lib/lightcase.min.js') }}"></script>
<script src="{{ asset('assets/global/js/select2.min.js') }}"></script>

<script src="{{ asset('assets/global/js/datepicker.min.js') }}"></script>
<script src="{{ asset('assets/global/js/datepicker.en.js') }}"></script>
<!-- main js -->
<script src="{{ asset($activeTemplateTrue . 'js/app.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'js/owl.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'js/wow.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'js/slick.min.js') }}"></script>
<script src="{{ asset($activeTemplateTrue . 'js/main.js') }}"></script>


@include('partials.plugins')

@include('partials.notify')

@stack('script-lib')

@stack('script')

<script>
    $(document).on('click', '.add-to-wish-list', function () {
        var property_id = $(this).data('id');
        var properties = $(`.add-to-wish-list[data-id="${property_id}"]`);
        var data = {
            property_id: property_id,
        };
        //add to wishlist
        if ($(this).hasClass('active')) {
            $.ajax({
                url: "{{ route('removeFromWishlist-home', ':id') }}".replace(':id', property_id),
                method: "get",
                success: function (response) {
                    if (response.success) {
                        getWishlistData();
                        getWishlistTotal();

                        $.each(properties, function (i, v) {
                            if ($(v).hasClass('active')) {
                                $(v).removeClass('active');
                                var icon = $(v).find('i');
                                icon.removeClass('las la-heart');
                                icon.addClass('lar la-heart');
                            }
                        });
                        notify('success', response.success);
                    } else if (response.error) {
                        notify('error', response.error);
                    } else {
                        notify('error', response);
                    }
                }
            });
        } else {
            $.ajax({
                url: "{{ route('add-to-wishlist') }}",
                method: "get",
                data: data,
                success: function (response) {
                    if (response.success) {
                        getWishlistData();
                        getWishlistTotal();

                        $.each(properties, function (i, v) {
                            if (!$(v).hasClass('active')) {
                                $(v).addClass('active');
                                var icon = $(v).find('i');
                                icon.removeClass('lar la-heart');
                                icon.addClass('las la-heart');
                            }
                        });
                        notify('success', response.success);
                    } else if (response.error) {
                        notify('error', response.error);
                    } else {
                        notify('error', response);
                    }
                }
            });
        }
    });


    function getWishlistData() {
        $.ajax({
            url: "{{ route('get-wishlist-data') }}",
            method: "get",
            success: function (response) {
                $('.wish-products').html(response);
            }
        });
    }

    function getWishlistTotal() {
        $.ajax({
            url: "{{ route('get-wishlist-total') }}",
            method: "get",
            success: function (response) {
                $('.wishlist-count').text(response);
            }
        });
    }
</script>


<script>
    (function ($) {
        "use strict";
        $(".langSel").on("change", function () {
            window.location.href = "{{ route('home') }}/change/" + $(this).val();
        });

    })(jQuery);
</script>

<script>
    $(document).ready(function () {
        // Show the feedback modal after 3 minutes (180000 milliseconds)
        setTimeout(function () {
            $("#feedbackModal").modal("show");
        }, 180000); // 3 minutes

        // Star Rating Logic
        $("#starRating .fa-star").on("click", function () {
            const rating = $(this).data("rating");
            $("#starRating .fa-star").removeClass("selected");
            $(this).prevAll().addBack().addClass("selected"); // Highlight selected stars
            $("#feedbackForm").data("rating", rating); // Store rating in form data
        });

        // Submit Feedback
        $("#submitFeedback").on("click", function () {
            const rating = $("#feedbackForm").data("rating");
            const feedbackText = $("#feedbackText").val();

            if (!rating) {
                alert("Please provide a star rating.");
                return;
            }

            // Send feedback to Laravel route
            $.ajax({
                url: '{{ route("feedback.store") }}',
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token for security
                    rating: rating,
                    feedback: feedbackText,
                },
                success: function (response) {
                    alert(response.message);
                    $("#feedbackModal").modal("hide");
                    $("#feedbackForm").trigger("reset");
                    $("#starRating .fa-star").removeClass("selected");
                },
                error: function (xhr) {
                    alert("There was an error submitting your feedback. Please try again.");
                },
            });
        });
    });
</script>

</body>

</html>
