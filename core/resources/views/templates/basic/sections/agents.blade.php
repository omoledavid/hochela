  @php
  $agents = getContent('agents.content', true);
  $properties = \App\Models\Property::with('location', 'rooms')
  ->whereHas('rooms', function($room){
  $room->where('status', 1);
  })
  ->orderBy('all_time_booked_counter', 'DESC')->limit(5)->get();
  $agents_landlords = \App\Models\Owner::where('status', 1)->orderBy('id', 'DESC')->limit(10)->whereNotNull('image')->get();
  @endphp
  <!-- best trip section start -->

  <!-- best trip section end -->
  <section class="pt-100 pb-100">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <div class="section-header">
            <h2 class="section-title">{{ __($agents->data_values->heading) }}</h2>
            <p class="mt-2">{{ __($agents->data_values->sub_heading) }}</p>
          </div>
        </div>
      </div><!-- row end -->
      <div class="row gy-4 justify-content-center">
        @foreach ($agents_landlords as $agent)
        <div class="col-lg-3 col-sm-6">
          <div class="mentor-card">
            <div class="mentor-card__thumb">
              <img src="{{getImage('assets/images/user/profile/'.$agent->image,'350x350')}}" alt="image">
            </div>
            <div class="mentor-card__content">
              <h4 class="name"><a href="{{route('agents_details', $agent->id)}}">{{__($agent->firstname)}}</a></h4>
              <p>
                @if($general->ar == 1)
                @php
                echo ratings(5)
                @endphp
                @endif
              </p>
              <form id="agentSearch" action="{{ route('property.search') }}" class="hero-search-form">
                <a type="javascript{}" onclick="document.getElementById('agentSearch').submit();">
                  <input type="hidden" name="agent_id" value="{{$agent->id}}">
                  <span role="button" class="text--base">{{__(\App\Models\Property::where('owner_id', $agent->id)->count())}} Porperties</span>
                </a>
              </form>
            </div>
          </div><!-- mentor-card end -->
        </div>
        @endforeach
      </div>
      <div class="col-lg-12 mt-5 text-center">
        @if($agents_landlords->count() >= 4)
        <a href="{{ route('agents') }}" class="btn btn-lg btn-outline--base">@lang('View all agents')</a>        
        @endif
      </div>
    </div>
  </section>