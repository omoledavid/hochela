@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md  table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th>@lang('Owner')</th>
                                <th>@lang('Email-Phone')</th>
                                <th>@lang('Country')</th>
                                <th>@lang('Joined At')</th>
                                <th>@lang('Balance')</th>
                                <th>@lang('Action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($bloggers as $blogger)
                            <tr>
                                <td data-label="@lang('Owner')">
                                    <span class="font-weight-bold">{{$blogger->fullname}}</span>
                                    <br>
                                    <span class="small">
                                    <a href="{{ route('admin.bloggers.detail', $blogger->id) }}"><span>@</span>{{ $blogger->username }}</a>
                                    </span>
                                </td>


                                <td data-label="@lang('Email-Phone')">
                                    {{ $blogger->email }}<br>{{ $blogger->mobile }}
                                </td>
                                <td data-label="@lang('Country')">
                                    <span class="font-weight-bold" data-toggle="tooltip" data-original-title="{{ @$blogger->address->country }}">{{ $blogger->country_code }}</span>
                                </td>


                                <td data-label="@lang('Joined At')">
                                    {{ showDateTime($blogger->created_at) }} <br> {{ diffForHumans($blogger->created_at) }}
                                </td>

                                <td data-label="@lang('Balance')">
                                    <span class="font-weight-bold">
                                        
                                    {{ $general->cur_sym }}{{ showAmount($blogger->balance) }}
                                    </span>
                                </td>

                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.bloggers.detail', $blogger->id) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="@lang('Details')">
                                        <i class="las la-desktop text--shadow"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ paginateLinks($bloggers) }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('breadcrumb-plugins')
    <form action="{{ route('admin.bloggers.search', $scope ?? str_replace('admin.bloggers.', '', request()->route()->getName())) }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Ownername or email')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
