@php
    $agentsHeading = getContent('agents.content', true);
@endphp
    <!-- best trip section start -->

<!-- best trip section end -->
<section class="pt-100 pb-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-header">
                    <h2 class="section-title">{{ __($agentsHeading->data_values->heading) }}</h2>
                    <p class="mt-2">{{ __($agentsHeading->data_values->sub_heading) }}</p>
                </div>
            </div>
        </div><!-- row end -->
        <div class="row gy-4 justify-content-center">
            @foreach ($agents as $agent)
                @if ($agent->properties_count >= 2)
                    <!-- Ensure the count check matches your conditions -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="mentor-card">
                            <div class="mentor-card__thumb">
                                <img src="{{ getImage('assets/images/user/profile/'.$agent->image, '350x350') }}"
                                     alt="image">
                            </div>
                            <div class="mentor-card__content">
                                <h4 class="name">
                                    <a href="{{ route('agents_details', $agent->id) }}">{{ __($agent->firstname) }}</a>
                                </h4>
                                <p>
                                    @if ($general->ar == 1)
                                        {!! ratings(5) !!}
                                    @endif
                                </p>
                                <form id="agentSearch-{{ $agent->id }}" action="{{ route('property.search') }}"
                                      class="hero-search-form">
                                    <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                    <button type="submit" class="btn text--base">
                                        {{ $agent->properties_count == 1 ? $agent->properties_count.' Property' : $agent->properties_count.' Properties' }}
                                    </button>
                                </form>
                            </div>
                        </div><!-- mentor-card end -->
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-lg-12 mt-5 text-center">
            @if ($agents->count() >= 4)
                <a href="{{ route('agents') }}" class="btn btn-lg btn-outline--base">@lang('View all agents')</a>
            @endif
        </div>
    </div>
</section>

