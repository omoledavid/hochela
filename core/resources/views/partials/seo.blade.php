@if($seo)
    <meta name="title" Content="{{ $general->sitename(__($pageTitle)) }}">
    <meta name="description" content="{{ $seo->description }}">
    <meta name="keywords" content="{{ implode(',',$seo->keywords) }}">
    <link rel="shortcut icon" href="{{ getImage(imagePath()['logoIcon']['path'] .'/favicon.png') }}"
          type="image/x-icon">

    {{--<!-- Apple Stuff -->--}}
    <link rel="apple-touch-icon" href="{{ getImage(imagePath()['logoIcon']['path'] .'/logo.png') }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ $general->sitename($pageTitle) }}">
    {{--<!-- Google / Search Engine Tags -->--}}
    @if(isset($seo_blog))
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{$blog->title}}">
        <meta property="og:description" content="{{ $blog->short_description}}">
        <meta property="og:image" content="{{ getImage('assets/images/news/' . $blog->image, '860x550') }}"/>
        <meta property="og:image:type"
              content="image/{{ pathinfo(getImage('assets/images/news/' . $blog->image) .'/'. $blog->image)['extension'] }}"/>
    @else
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $seo->social_title }}">
        <meta property="og:description" content="{{ $seo->social_description }}">
        <meta property="og:image" content="{{ getImage(imagePath()['seo']['path'] .'/'. $seo->image) }}"/>
        <meta property="og:image:type"
              content="image/{{ pathinfo(getImage(imagePath()['seo']['path']) .'/'. $seo->image)['extension'] }}"/>
    @endif
    <meta itemprop="name" content="{{ $general->sitename($pageTitle) }}">
    <meta itemprop="description" content="{{ $general->seo_description }}">
    <meta itemprop="image" content="{{ getImage(imagePath()['seo']['path'] .'/'. $seo->image) }}">
    {{--<!-- Facebook Meta Tags -->--}}

    @php $social_image_size = explode('x', imagePath()['seo']['size']) @endphp
    <meta property="og:image:width" content="{{ $social_image_size[0] }}"/>
    <meta property="og:image:height" content="{{ $social_image_size[1] }}"/>
    <meta property="og:url" content="{{ url()->current() }}">
    {{--<!-- Twitter Meta Tags -->--}}
    <meta name="twitter:card" content="summary_large_image">
@endif
