@extends($activeTemplate.'layouts.frontend')
@section('content')
<section class="pt-100 pb-100">
  <div class="container">
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
              @php
              echo ratings(5)
              @endphp</p>
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
  </div>
</section>
@endsection