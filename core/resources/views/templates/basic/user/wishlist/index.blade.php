@extends($activeTemplate.'layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="custom--card">
                    <div class="card-header p-3"><h6 class="d-inline">Wishlist</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive--md">
                            <table class="table custom--table">
                                <thead>
                                <tr>
                                    <th>@lang('Property Name')</th>
                                    <th>@lang('Status')</th>
                                    <th>@lang('Available Slot')</th>
                                    <th>@lang('Action')</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($wishlist_data as $data)
                                    <tr>
                                        <td data-label="@lang('Last Reply')">{{$data->property->name}}</td>
                                        <td data-label="@lang('Last Reply')">
                                            @if($data->property->status == 1)
                                                Availale
                                            @else
                                                Not Available
                                            @endif
                                        </td>
                                        <td data-label="@lang('available slot')">
                                            {{$data->property->available_rooms}}
                                        </td>
                                        <td data-label="@lang('Action')">
                                            <span class="edit remove-wishlist" data-id="{{$data->id}}" data-page="1">
                                                <i class="las la-trash"></i>
                                            </span>

                                            <a href="{{ route('property', [$data->property->id, slug($data->property->name)]) }}"
                                               class="quick-view-btn">
                                                <span class="edit add-cart">
                                                    <i class="las la-eye"></i>
                                                </span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{$wishlist_data->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('style')
    <style>
        a:hover {
            color: #7367F0;
        }
    </style>
@endpush
