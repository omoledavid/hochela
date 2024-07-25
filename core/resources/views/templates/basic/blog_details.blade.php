@extends($activeTemplate . 'layouts.frontend')
@section('head_content')
    <meta name="name" content="This is a different description rom blade">
@overwrite
@section('content')
    <div class="as-location-page">
        <div class="container">
            <div class="row gy-5">
                <div class="col-lg-8">
                    <div class="blog-post">
                        <img src="{{ getImage('assets/images/news/' . $blog->image, '860x550') }}" alt="viserfly"
                             class="img-fluid w-100"/>
                        <div class="blog-post__body">
                            <div class="blog-post__date">
                                <h2 class="text-white">{{ showDateTime($blog->created_at, 'd') }}</h2>
                                <p class="text-white text-capitalize">{{ showDateTime($blog->created_at, 'M') }}</p>
                            </div>
                            <h2 class="text-capitalize mb-3">
                                {{ __($blog->title) }}
                            </h2>
                            <ul class="list list--row">
                                <li class="list--row__item">
                                    <div class="blog-post__meta">
                                        <div class="blog-post__meta-icon me-2">
                                            <i class="las la-clock"></i>
                                        </div>
                                        <div class="blog-post__meta-text text-uppercase">
                                            <span class="blog-post__link">{{ diffForHumans($blog->created_at) }} </span>
                                        </div>
                                        <div>
                                            <p> &nbsp; | <i>Written by</i> {{ $blog->author }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div>
                                {{-- @dd($blog->description) --}}
                                {!! $blog->description !!}
                            </div>
                            <div class="blog-details__share mt-4 d-flex align-items-center flex-wrap">
                                <h5 class="social-share__title mb-0 me-sm-3 me-1 d-inline-block">@lang('Share This')</h5>
                                <ul class="social-list">
                                    <li class="social-list__item">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                           class="social-list__link flex-center"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="https://twitter.com/intent/tweet?text={{ __(@$blog->title) }}%0A{{ url()->current() }}"
                                           class="social-list__link flex-center"> <i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url={{ urlencode(url()->current()) }}&amp;title={{ __(@$blog->data_values->title) }}&amp;summary={{ __(@$blog->description) }}"
                                           class="social-list__link flex-center"> <i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="http://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&description={{ __(@$blog->title) }}&media={{ getImage('assets/images/frontend/blog/' . @$blog->image, '970x490') }}"
                                           class="social-list__link flex-center"> <i class="fab fa-pinterest"></i></a>
                                    </li>
                                    <li class="social-list__item">
                                        <a href="https://wa.me/?text={{ urlencode(url()->current()) }}"
                                           class="social-list__link flex-center"> <i class="fab fa-whatsapp"></i></a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="fb-comments"
                             data-href="{{ route('blog.details', [$blog->id, slug($blog->title)]) }}"
                             data-numposts="5"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="sticky-top">
                        <ul class="list list--column">
                            <li class="list--column__item-xl">
                                <div class="widget">
                                    <h4 class="widget__title text-capitalize mb-4 mt-0">
                                        @lang('Recent Posts')
                                    </h4>
                                    <ul class="list list--column widget-category">
                                        @foreach ($recentBlogs as $blog)
                                            <li class="list--column__item widget-category__item">
                                                <div class="d-flex pb-3">
                                                    <div class="me-3 flex-shrink-0">
                                                        <div class="user__img user__img--md">
                                                            <img
                                                                src="{{ getImage('assets/images/news/' . $blog->image, '430x275') }}"
                                                                alt="hochela" class="user__img-is"/>
                                                        </div>
                                                    </div>
                                                    <div class="article">
                                                        <h5 class="texte-capitalize t-fw-md mt-0 mb-2">
                                                            <a href="{{ route('blog.details', [$blog->id, slug($blog->title)]) }}"
                                                               class="t-link d-inline-block t-text-heading fw-md t-link--primary text-capitalize">
                                                                {{ __($blog->title) }}
                                                            </a>
                                                        </h5>
                                                        <ul class="list list--row">
                                                            <li class="list--row__item">
                                                                <div class="blog-post__meta">
                                                                    <div class="blog-post__meta-icon me-2">
                                                                        <i class="las la-clock"></i>
                                                                    </div>
                                                                    <div class="blog-post__meta-text text-uppercase">

                                                                        <a href="{{ route('blog.details', [$blog->id, slug($blog->title)]) }}"
                                                                           class="blog-post__link">{{ showDateTime($blog->created_at) }}</a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('fbComment')
    @php echo loadFbComment() @endphp
@endpush
