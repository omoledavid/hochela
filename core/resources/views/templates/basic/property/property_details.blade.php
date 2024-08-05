@extends($activeTemplate.'layouts.frontend')
@section('content')
    <!-- hotel deatils section start -->
    <section class="pb-100">
        <div class="hotel-details-thumb-slider">
            <div class="single-slide">
                <div class="hotel-details-thumb">
                    <a href="{{ getImage(imagePath()['property']['path'] . '/' . $property->image, imagePath()['property']['size']) }}"
                       class="lightcase full-view" data-rel="lightcase"><i
                            class="las la-image"></i>@lang('See Full View')
                    </a>
                    <img
                        src="{{ getImage(imagePath()['property']['path'] . '/' . $property->image, imagePath()['property']['size']) }}"
                        alt="image">
                </div>
            </div><!-- single-slide end -->
            @foreach ($property->images as $image)
                <div class="single-slide">
                    <div class="hotel-details-thumb">
                        <a href="{{ getImage(imagePath()['property']['path'] . '/' . $image, imagePath()['property']['size']) }}"
                           class="lightcase full-view" data-rel="lightcase"><i class="las la-image"></i>@lang('See Full
                    View')
                        </a>
                        <img
                            src="{{ getImage(imagePath()['property']['path'] . '/' . $image, imagePath()['property']['size']) }}"
                            alt="image">
                    </div>
                </div><!-- single-slide end -->
            @endforeach
        </div><!-- hotel-details-thumb-slider end -->
        <div class="container pt-50">
            <div class="row">
                <div class="col-lg-8">

                    <ul class="nav hotel-nav">
                        <li class="hotel-nav__item">
                            <button class="nav-link w-100 hotel-nav__btn active" data-bs-toggle="pill"
                                    data-bs-target="#hotel-description" type="button">@lang('Description')</button>
                        </li>
                        {{--                    <li class="hotel-nav__item">--}}
                        {{--                        <button class="nav-link w-100 hotel-nav__btn" data-bs-toggle="pill" data-bs-target="#hotel-category" type="button">@lang('Rooms')</button>--}}
                        {{--                    </li>--}}
                        @if($general->pr == 1)
                            <li class="hotel-nav__item">
                                <button class="nav-link w-100 hotel-nav__btn" data-bs-toggle="pill"
                                        data-bs-target="#hotel-review" type="button">@lang('Review')</button>
                            </li>
                        @endif
                        <li class="hotel-nav__item">
                            <button class="nav-link w-100 hotel-nav__btn" data-bs-toggle="pill"
                                    data-bs-target="#hotel-location" type="button">@lang('Location')</button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        @include($activeTemplate.'property.property_details_description')
                        @include($activeTemplate.'property.property_details_rooms')
                        @include($activeTemplate.'property.property_details_reviews')
                        @include($activeTemplate.'property.property_details_location')
                    </div>
                    <h3 class="mt-2 mb-3">@lang('Posted by')</h3>
                    <div class="instructor-card">
                        <div class="thumb">
                            <img
                                src="{{getImage('assets/images/user/profile/'.\App\Models\Owner::find($property->owner_id)->image,'350x350')}}"
                                alt="image">
                        </div>
                        <div class="content">
                            <a href="{{route('agents_details', $agent->id)}}">
                                <h4 class="name">{{$agent->firstname}} {{$agent->lastname}}</h4>
                            </a> <br>
                            <span class="mt-1">Agent</span>
                            <ul class="instructor-info-list d-flex flex-wrap align-items-center">
                                <li>
                                    <i class="las la-layer-group"></i>
                                    <span>{{$propertiesByAgent}} @lang('Properties')</span>
                                </li>
                                @if($general->ar == 1)
                                    <li>
                                        <i class="las la-star"></i>
                                        <span>2 @lang('Reviews')</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                        <p class="w-100 mt-2">{{$agent->about_me}}</p>
                    </div>
                </div>
                <div class="col-lg-4 mt-lg-0 mt-4">
                    <div class="hotel-details-sidebar">
                        <div class="reserve-widget">
                            <div class="top text-center">
                                @if ($property->discount != 0)
                                    <div class="hotel-details-offer-badge">
                                        <b>{{ $property->discount }}%</b> <br>
                                        <span>@lang('off')</span>
                                    </div>
                                @endif
                                <h4>@lang('Amount')</h4>
                                <div class="price">
                                    <span
                                        class="text--base">{{ $general->cur_sym }}{{ showAmount(($property->property_amount)) }}</span>
                                    <sub>/ @lang('per year')</sub>
                                </div>
                            </div>
                            @if (isset($request))
                                @if ($request->location && $request->date && $request->adult)
                                    <form action="{{ route('property.rooms') }}">
                                        <input type="hidden" name="property" value="{{ $property->id }}">
                                        <input type="hidden" name="location" value="{{ $request->location }}">
                                        <input type="hidden" name="date" value="{{ $request->date }}">
                                        <input type="hidden" name="adult" value="{{ $request->adult }}">
                                        <input type="hidden" name="child" value="{{ $request->child }}">
                                    </form>
                                @else
                                    <form action="{{ route('property.rooms') }}">
                                        <input type="hidden" name="property" value="{{ $property->id }}">
                                        <input type="hidden" name="location" value="{{ $request->location }}">
                                        <input type="hidden" name="date" value="{{ $request->date }}">
                                        <input type="hidden" name="adult" value="{{ $request->adult }}">
                                        <input type="hidden" name="child" value="{{ $request->child }}">
                                        <button type="submit" class="btn btn--base w-100 mt-4">@lang('Sell All
                                Rooms')</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                        <div class="book-widget mt-4 text-center text-white">
                            <i class="lar la-calendar"></i>
                            <h3 class="text-white mt-2 mb-2">@lang('Schedule an appointment')</h3>
                            @guest
                                <p>Login to book an appointment</p>
                                <a href="{{route('user.login')}}"
                                   class="btn mt-2 btn--base w-100">@lang('Login')</a>
                            @endguest
                            @auth
                                <form method="POST" action="{{route('user.conversation.booking')}}">
                                    @csrf
                                    <input type="hidden" name="agent_id" value="{{$agent->id}}">
                                    <input class="form-control" name="time" type="datetime-local"
                                           placeholder="Select date" required>
                                    <button type="submit" class="btn mt-3 btn--base w-100"
                                            style="width:100%;">@lang('Submit')</button>
                                </form>
                            @endauth
                        </div>
                        <div class="sticky-top mt-3">
                            <ul class="list list--column">
                                <li class="list--column__item-xl">
                                    <div class="widget">
                                        <h4 class="widget__title text-capitalize mb-4 mt-0">
                                            @lang('Related Properties')
                                        </h4>
                                        <ul class="list list--column widget-category">
                                            @foreach($related_properties as $related_property)
                                                <li class="list--column__item widget-category__item">
                                                    <div class="d-flex pb-3">
                                                        <div class="me-3 flex-shrink-0">
                                                            <div style="border-radius: 5px !important;"
                                                                 class="user__img user__img--md">
                                                                <img
                                                                    src="{{ getImage(imagePath()['property']['path'] . '/' . $related_property->image, imagePath()['property']['size']) }}"
                                                                    alt="hochela" class="user__img-is"/>
                                                            </div>
                                                        </div>
                                                        <div class="article">
                                                            <h5 class="texte-capitalize t-fw-md mt-0 mb-2">
                                                                <a href="{{ route('property', [$related_property->id, slug($related_property->name)]) }}"
                                                                   class="t-link d-inline-block t-text-heading fw-md t-link--primary text-capitalize">
                                                                    {{$related_property->name}}
                                                                </a>
                                                            </h5>
                                                            <ul class="list list--row">
                                                                <li class="list--row__item">
                                                                    <div class="blog-post__meta">
                                                                        <div class="blog-post__meta-icon me-2">
                                                                            {{$related_property->propertyTypeSingle->name}}
                                                                        </div>
                                                                        <div
                                                                            class="blog-post__meta-text text-uppercase">

                                                                            <a href=""
                                                                               class="blog-post__link"></a>
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
        </div>
    </section>
    <!-- hotel deatils section end -->
@endsection
