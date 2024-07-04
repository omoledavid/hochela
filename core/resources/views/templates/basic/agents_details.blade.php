@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pt-100 pb-100 text-break">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="instructor-card">
          <div class="thumb">
            <img src="{{getImage('assets/images/user/profile/'.$agents->image,'350x350')}}" alt="image">
          </div>
          <div class="content">
            <h4 class="name">{{$agents->firstname.' '.$agents->lastname;}}</h4>
            <span class="mt-1"></span>
            <ul class="instructor-info-list d-flex flex-wrap align-items-center">
              <li>
                <i class="las la-layer-group"></i>
                <span>{{$properties}} @lang('Properties')</span>
              </li>
              @if($general->ar == 1)
              <li>
                <i class="las la-star"></i>
                <span>{{$review_count}} @lang('Reviews')</span>
              </li>
              @endif
            </ul>
          </div>
          <p class="w-100 mt-2">{{$agents->about_me}}</p>
        </div>

        <ul class="nav nav-tabs cumtom--nav-tabs mt-5" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="comment-tab" data-bs-toggle="tab" data-bs-target="#comment" type="button" role="tab" aria-controls="comment" aria-selected="true">@lang('Properties')</button>
          </li>
          @if($general->ar == 1)
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab" aria-controls="overview" aria-selected="false">@lang('All Reviews')</button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link" id="annoucement-tab" data-bs-toggle="tab" data-bs-target="#annoucement" type="button" role="tab" aria-controls="annoucement" aria-selected="false">@lang('Give Review')</button>
          </li>
          @endif
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="comment" role="tabpanel" aria-labelledby="comment-tab">
            <div class="col-xxl-12 mt-5 col-xl-12 pe-xl-12">
              <div class="best-trip-slider">
                @foreach ($properties_all as $property)
                <div class="single-slide">
                  <div class="best-trip-card">
                    @if ($property->discount != 0)
                    <div class="best-trip-card__badge">
                      <b>{{ showAmount($property->discount) }}%</b> <br>
                      <span>@lang('off')</span>
                    </div>
                    @endif
                    <div class="thumb">
                      <img src="{{ getImage(imagePath()['property']['path'].'/'. $property->image, imagePath()['property']['size']) }}" alt="image">
                    </div>
                    <div class="content">
                      <div class="top">
                        <div class="ratings">
                          @for ($i = 0; $i < round($property->rating); $i++)
                            <i class="las la-star"></i>
                            @endfor
                            <span class="fs--14px">({{ $property->review }})</span>
                        </div>
                        <h4 class="name">{{ __($property->name) }}</h4>
                        <span class="fs--14px mt-2"><i class="las la-map-marked-alt fs--18px"></i> @lang('in') {{ __($property->location->name) }}</span>
                      </div>
                      <div class="bottom d-flex align-items-center">
                        <div class="col-6">
                          <div class="price text--base">
                            @php
                            $lowestPrice = $property->rooms[0]->price;
                            foreach ($property->rooms as $room) {
                            if($room->price < $lowestPrice){ $lowestPrice=$room->price;
                              }
                              }
                              echo $general->cur_sym.showAmount($lowestPrice);
                              @endphp
                          </div>
                          <span class="fs--14px">@lang('Per year')</span>
                        </div>
                        <div class="col-6 text-end">
                          <a href="{{ route('property', [$property->id, slug($property->name)]) }}" class="btn btn-sm btn--base">@lang('View Details')</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- single-slide end -->
                @endforeach

              </div>
            </div>
          </div>


          <div class="tab-pane fade" id="overview" role="tabpanel" aria-labelledby="overview-tab">
            <div class="rating-area mt-5">
              <div class="single-rating-wrapper">
                <!-- single-rating end -->
                @forelse ($agents->reviews as $review)
                <div class="single-rating">
                  <div class="single-rating__thumb">
                    <img src="{{getImage('assets/images/user/profile/'.$review->user->image,'350x350')}}" alt="image">
                  </div>
                  <div class="single-rating__content">
                    <h5 class="name">{{$review->user->fullname}}</h5>
                    <div class="d-flex align-items-center mt-1">
                      <div class="ratings d-flex align-items-center justify-content-end fs--18px">
                        @php
                        echo ratings($review->stars);
                        @endphp
                      </div>
                      <span class="text-muted ms-2">{{diffForHumans($review->created_at)}}</span>
                    </div>
                    <p class="mt-2">{{__($review->review)}}</p>
                  </div>
                </div><!-- single-rating end -->
                @empty
                <div class="single-rating">
                  <div class="single-rating__content">
                    <div class="d-flex align-items-center mt-1">
                      <h4>@lang('No reviews yet !!')</h4>
                    </div>
                  </div>
                </div><!-- single-rating end -->
                @endforelse<!-- single-rating end -->

              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="annoucement" role="tabpanel" aria-labelledby="annoucement-tab">
            <div class="annoucement-area mt-4">
              @guest
              <h3 class="block-title text--danger text-center">@lang('Please login first')</h3>
              @endguest
              @auth
              <form class="review-form rating mt-4" method="POST" action="{{route('review')}}">
                @csrf
                <input type="hidden" name="agent_id" value="{{$agents->id}}">
                <input type="hidden" name="author_id" value="">
                <div class="form-group d-flex flex-wrap">
                  <label class="review-label text-dark fw-medium mb-0 me-3">@lang('Your Ratings') :</label>
                  <div class="rating-form-group">
                    <label class="star-label">
                      <input type="radio" name="rating" value="1" />
                      <span class="icon"><i class="las la-star"></i></span>
                    </label>
                    <label class="star-label">
                      <input type="radio" name="rating" value="2" />
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                    </label>
                    <label class="star-label">
                      <input type="radio" name="rating" value="3" />
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                    </label>
                    <label class="star-label">
                      <input type="radio" name="rating" value="4" />
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                    </label>
                    <label class="star-label">
                      <input type="radio" name="rating" value="5" />
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                      <span class="icon"><i class="las la-star"></i></span>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <textarea name="review" class="form--control" id="review-comments" required placeholder="@lang('Say Something about this agent')"></textarea>
                </div>
                <button type="submit" class="btn btn--base">@lang('Submit Review')</button>
              </form>
              @endauth
            </div>
          </div>
        </div>

      </div>
      <div class="col-lg-4 ps-lg-5 mt-lg-0 mt-5">
        <div class="course-details-sidebar">
          <div class="book-widget mt-4 text-center text-white">
            <i class="lar la-calendar"></i>
            <h3 class="text-white mt-2">@lang('Schedule an appointment')</h3>
              @guest
              <input class="form-control" name="time" type="datetime-local" placeholder="Select date" required>
              <a href="{{route('user.login')}}" class="btn mt-2 btn--base w-100">@lang('Book meeting')</a>
              @endguest
              @auth
              <form method="POST" action="{{route('user.conversation.booking')}}">
                @csrf
                <input type="hidden" name="agent_id" value="{{$agents->id}}">
                <input class="form-control" name="time" type="datetime-local" placeholder="Select date" required>
                <button type="submit" class="btn mt-2 btn--base w-100" style="width:100%;">@lang('Book Meeting')</button>
              </form>
              @endauth
          </div><!-- agent-details-widget end -->
        </div>
      </div><!-- agent-details-sidebar end -->
    </div>
  </div>
  </div>
</section>
@endsection