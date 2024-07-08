<div class="tab-pane fade" id="hotel-location">
    @if ($property->google_link)
        <div class="hotel-details-box pt-4">
            <h3 class="title mb-4">@lang('Location')</h3>
            <p class="mt-1">{{ __($property->apartment_location) }}</p>
            <div class="hotel-details-map">
                <iframe src="{{ $property->google_link }}" allowfullscreen=""
                    loading="lazy"></iframe>
            </div>
        </div><!-- hotel-details-box end -->
    @endif
</div>
