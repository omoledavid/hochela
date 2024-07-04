@extends($activeTemplate.'layouts.frontend')
@section('content')
<!-- hotel deatils section start -->
<section class="pb-100">
    <div class="hotel-details-thumb-slider">
        <div class="single-slide">
            <div class="hotel-details-thumb">
                <a href="{{ getImage(imagePath()['property']['path'] . '/' . $property->image, imagePath()['property']['size']) }}" class="lightcase full-view" data-rel="lightcase"><i class="las la-image"></i>@lang('See Full View')
                </a>
                <img src="{{ getImage(imagePath()['property']['path'] . '/' . $property->image, imagePath()['property']['size']) }}" alt="image">
            </div>
        </div><!-- single-slide end -->
        @foreach ($property->images as $image)
        <div class="single-slide">
            <div class="hotel-details-thumb">
                <a href="{{ getImage(imagePath()['property']['path'] . '/' . $image, imagePath()['property']['size']) }}" class="lightcase full-view" data-rel="lightcase"><i class="las la-image"></i>@lang('See Full
                    View')
                </a>
                <img src="{{ getImage(imagePath()['property']['path'] . '/' . $image, imagePath()['property']['size']) }}" alt="image">
            </div>
        </div><!-- single-slide end -->
        @endforeach
    </div><!-- hotel-details-thumb-slider end -->
    <div class="container pt-50">
        <div class="row">
            <div class="col-lg-8">

                <ul class="nav hotel-nav">
                    <li class="hotel-nav__item">
                        <button class="nav-link w-100 hotel-nav__btn active" data-bs-toggle="pill" data-bs-target="#hotel-description" type="button">@lang('Description')</button>
                    </li>
                    <li class="hotel-nav__item">
                        <button class="nav-link w-100 hotel-nav__btn" data-bs-toggle="pill" data-bs-target="#hotel-category" type="button">@lang('Rooms')</button>
                    </li>
                    @if($general->pr == 1)
                    <li class="hotel-nav__item">
                        <button class="nav-link w-100 hotel-nav__btn" data-bs-toggle="pill" data-bs-target="#hotel-review" type="button">@lang('Review')</button>
                    </li>
                    @endif
                    <li class="hotel-nav__item">
                        <button class="nav-link w-100 hotel-nav__btn" data-bs-toggle="pill" data-bs-target="#hotel-location" type="button">@lang('Location')</button>
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
                        <img src="{{getImage('assets/images/user/profile/'.\App\Models\Owner::find($property->owner_id)->image,'350x350')}}" alt="image">
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
                            <h4>@lang('Grade') {{ $property->star }} @lang('Standard')</h4>
                            @if (count($property->rooms))
                            <div class="price">
                                @if ($property->discount != 0)
                                <del>{{ $general->cur_sym }} {{ showAmount($lowestRoomPrice) }}</del>
                                <span class="text--base">{{ $general->cur_sym }}{{ showAmount(($lowestRoomPrice * (100 - $property->discount)) / 100) }}</span>
                                <sub>/ @lang('per year')</sub>
                                @else
                                <span class="text--base">{{ $general->cur_sym }}
                                    {{ showAmount($lowestRoomPrice) }}</span>
                                @endif
                            </div>
                            @else
                            <p>@lang('No room found')</p>
                            @endif
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
                        <i class="fas fa-mail-bulk"></i>
                        <h3 class="text-white mt-2">@lang('Send a message')</h3>
                        <form action="{{route('property.chat')}}">
                            @guest
                            <a href="{{route('user.login')}}" class="btn mt-2 btn--base w-100">@lang('Contact Now')</a>
                            @endguest
                            @auth
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#depoModal" class="btn mt-2 btn--base w-100">@lang('Contact Now')</a>
                            @endauth
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- hotel deatils section end -->
@endsection
@push('modal')
<div class="modal fade" id="depoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabel">@lang('Start new conversation')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('user.conversation.store')}}">
                    @csrf
                    <input type="hidden" name="recevier_id" value="{{$agent->id}}">

                    <div class="form-group">
                        <input type="hidden" class="form-control" name="subject" value="{{ __($property->name) }}" placeholder="@lang('Enter Subject')" maxlength="255" required>
                    </div>

                    <div class="form-group">
                        <label for="message" class="font-weight-bold">@lang('Message')</label>
                        <input class="form-control" name="message" value="Is the {{ __($property->name) }} property still available ?" placeholder="@lang('Enter Message')" required readonly>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn--base" style="width:100%;">@lang('Send Message')</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn--danger btn-rounded text-white" data-bs-dismiss="modal">@lang('Close')</button>
            </div>
        </div>
    </div>
</div>
@endpush