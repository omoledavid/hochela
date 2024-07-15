<div class="tab-pane fade show active" id="hotel-description">
    <div class="hotel-details-box pt-4">
        @if ($property->rating >= 4)
            <span class="fs--12px bg--primary text-white px-2 rounded-2 mb-2">@lang('Top
                Rated')</span>
        @endif
        @if ($property->top_reviewed)
            <span class="fs--12px bg--success text-white px-2 rounded-2 mb-2">@lang('Best
                Reviewed')</span>
        @endif
        <h2 class="hotel-name">{{ __($property->name) }}</h2>
        <p class="mt-1"><i class="las la-map-marker-alt fs--18px"></i>
            {{ __($property->location->name) }}</p>
        <ul class="features-list mt-2">
            @isset($property->extra_features)
                @foreach ($property->extra_features as $feature)
                    <li>{{ __($feature) }}</li>
                @endforeach
            @endisset
        </ul>
    </div><!-- hotel-details-box end -->
    <div class="hotel-details-box">
        @php
            echo $property->description;
        @endphp
    </div><!-- hotel-details-box end -->
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
