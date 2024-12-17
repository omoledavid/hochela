<!-- meta tags and other links -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $general->sitename($pageTitle ?? '') }}</title>
    <!-- site favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ getImage(imagePath()['logoIcon']['path'] . '/favicon.png') }}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap">
    <!-- bootstrap 4  -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/gird.min.css') }}">
    <!-- bootstrap toggle css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/bootstrap-toggle.min.css') }}">
    <!-- fontawesome 5  -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/all.min.css') }}">
    <!-- line-awesome webfont -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/line-awesome.min.css') }}">

    @stack('style-lib')

    <!-- custom select box css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/nice-select.css') }}">
    <!-- code preview css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/prism.css') }}">
    <!-- select 2 css -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/select2.min.css') }}">
    <!-- jvectormap css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/jquery-jvectormap-2.0.5.css') }}">
    <!-- datepicker css -->
    <link rel="stylesheet" href="{{ asset('assets/global/css/datepicker.min.css') }}">
    <!-- timepicky for time picker css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/jquery-timepicky.css') }}">
    <!-- bootstrap-clockpicker css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/bootstrap-clockpicker.min.css') }}">
    <!-- bootstrap-pincode css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/vendor/bootstrap-pincode-input.css') }}">
    <!-- dashdoard main css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/css/app.css') }}">

    <!-- summernote css -->
    <link rel="stylesheet" href="{{ asset('assets/laramin/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/laramin/summernote/summernote-lite.min.css') }}">

    <!-- ckeditor -->
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.css"/>

    <!-- If you are using premium features: -->
    <link rel="stylesheet"
          href="https://cdn.ckeditor.com/ckeditor5-premium-features/42.0.0/ckeditor5-premium-features.css"/>


    @stack('style')
    <style>
        /* For summernote override unordered and order list */
        .note-editable ul {
            list-style: disc !important;
            list-style-position: inside !important;
        }

        .note-editable ol {
            list-style: decimal !important;
            list-style-position: inside !important;
        }
    </style>
</head>

<body>
@yield('content')



<!-- jQuery library -->
<script src="{{ asset('assets/global/js/jquery-3.6.0.min.js') }}"></script>
<!-- bootstrap js -->
<script src="{{ asset('assets/laramin/js/vendor/grid.min.js') }}"></script>
<!-- bootstrap-toggle js -->
<script src="{{ asset('assets/laramin/js/vendor/bootstrap-toggle.min.js') }}"></script>

<!-- slimscroll js for custom scrollbar -->
<script src="{{ asset('assets/laramin/js/vendor/jquery.slimscroll.min.js') }}"></script>
<!-- custom select box js -->
<script src="{{ asset('assets/laramin/js/vendor/jquery.nice-select.min.js') }}"></script>


@include('partials.notify')
@stack('script-lib')

<script src="{{ asset('assets/laramin/js/nicEdit.js') }}"></script>
<script src="{{ asset('assets/laramin/js/cu-modal.js') }}"></script>

<!-- code preview js -->
<script src="{{ asset('assets/laramin/js/vendor/prism.js') }}"></script>
<!-- seldct 2 js -->
<script src="{{ asset('assets/global/js/select2.min.js') }}"></script>
<!-- main js -->
<script src="{{ asset('assets/laramin/js/app.js') }}"></script>
<script src="{{ asset('assets/laramin/summernote/summernote-lite.min.js') }}"></script>
<!-- summernote text editor -->
<script>
    $(document).ready(function () {
        $("#summernote").summernote({
            placeholder: "{{ __('Description') }}",
            minHeight: 300,
            focus: true,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['bold', 'underline', 'strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['height', ['height']],
                ['view', ['fullscreen', 'help']],
                ['remove', ['removeMedia']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function (files) {
                    // Upload image to server using Laravel's route
                    uploadImage(files[0], $(this));
                },
            }
        });


        $('#summernote').summernote('formatPara');


        function uploadImage(file, editor) {
            var formData = new FormData();
            formData.append('file', file);
            formData.append('_token', '{{ csrf_token() }}'); // Include CSRF token

            $.ajax({
                url: "{{ route('upload.image') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    var imageUrl = response.url;
                    editor.summernote('insertImage', imageUrl);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error("Error uploading image: " + textStatus, errorThrown);
                }
            });
        }
    });
</script>

{{-- LOAD NIC EDIT --}}
<script>
    "use strict";
    bkLib.onDomLoaded(function () {
        $(".nicEdit").each(function (index) {
            $(this).attr("id", "nicEditor" + index);
            new nicEditor({
                fullPanel: true
            }).panelInstance('nicEditor' + index, {
                hasPanel: true
            });
        });
    });
    (function ($) {
        $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function () {
            $('.nicEdit-main').focus();
        });
    })(jQuery);
</script>
<script>
    // Initialize and add the map
    function initAutocomplete() {
        // Ensure the input element exists before initializing autocomplete
        var input = document.getElementById('place_location');
        if (!input) {
            console.error('Input element not found');
            return;
        }

        // Create the autocomplete object, restricting the search to geographical location types.
        var autocomplete = new google.maps.places.Autocomplete(input, {types: ['geocode']});

        console.log('Autocomplete initialized');

        // Add event listener for the place_changed event
        autocomplete.addListener('place_changed', function () {
            fillInAddress(autocomplete);
        });
    }

    function fillInAddress(autocomplete) {
        var place = autocomplete.getPlace();

        if (place.geometry) {
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var embedUrl = getEmbedUrl(lat, lng);
            console.log('Embedded URL:', embedUrl);

            // Display the embedded map in an iframe or use the URL as needed
            document.getElementById('input_map_embed').value = embedUrl;
        }
    }

    function getEmbedUrl(lat, lng) {
        return `https://www.google.com/maps/embed/v1/view?key={{env('GOOGLE_PLACE_API_KEY')}}&center=${lat},${lng}&zoom=14&maptype=roadmap`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Load the Google Maps script asynchronously
        var script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_PLACE_API_KEY')}}&libraries=places&callback=initAutocomplete';
        script.async = true;
        script.defer = true;
        document.head.appendChild(script);
    });
</script>

@stack('script')


</body>

</html>
