@extends('admin.layouts.app')

@section('panel')
<div class="row mb-none-30">
    <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

        <div class="card b-radius--10 overflow-hidden box--shadow1">
            <div class="card-body p-0">
                <div class="p-3 bg--white">
                    <h4 class="">{{$user->fullname}}</h4>
                    <span class="text--small">@lang('Joined At') <strong>{{showDateTime($user->created_at,'d M, Y h:i A')}}</strong></span>
                </div>
            </div>
        </div>

        <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
            <div class="card-body">
                <h5 class="mb-20 text-muted">@lang('User information')</h5>
                <ul class="list-group">

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Username')
                        <span class="font-weight-bold">{{$user->username}}</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Status')
                        @if($user->status == 1)
                        <span class="badge badge-pill bg--success">@lang('Active')</span>
                        @elseif($user->status == 0)
                        <span class="badge badge-pill bg--danger">@lang('Banned')</span>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        
    </div>

    <div class="col-xl-9 col-lg-7 col-md-7 mb-30">

        <div class="row mb-none-30">
            <div class="col-xl-4 mb-30">
                <div class="dashboard-w1 bg--deep-purple b-radius--10 box-shadow has--link">
                    <a href="{{route('admin.staffs.deposits',$user->id)}}" class="item--link"></a>
                    <div class="icon">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="currency-sign"> {{__($general->cur_sym)}}</span>
                            <span class="amount">{{showAmount($totalDeposit)}}</span>
                        </div>
                        <div class="desciption">
                            <span>@lang('Total Payment')</span>
                        </div>
                    </div>
                </div>
            </div><!-- dashboard-w1 end -->

            <div class="col-xl-4 mb-30">
                <div class="dashboard-w1 bg--12 b-radius--10 box-shadow has--link">
                    <a href="{{route('admin.staffs.tickets',$user->id)}}" class="item--link"></a>
                    <div class="icon">
                        <i class="la la-exchange-alt"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{$totalTickets}}</span>
                        </div>
                        <div class="desciption">
                            <span>@lang('Total Ticket')</span>
                        </div>
                    </div>
                </div>
            </div><!-- dashboard-w1 end -->

            <div class="col-xl-4 mb-30">
                <div class="dashboard-w1 bg--17 b-radius--10 box-shadow has--link">
                    <a href="{{ route('admin.staffs.booked.properties', $user->id) }}" class="item--link"></a>
                    <div class="icon">
                        <i class="la la-exchange-alt"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $totalBookedProperties }}</span>
                        </div>
                        <div class="desciption">
                            <span>@lang('Total Property Booked')</span>
                        </div>
                    </div>
                </div>
            </div><!-- dashboard-w1 end -->


        </div>


        <div class="card mt-50">
            <div class="card-body">
                <h5 class="card-title border-bottom pb-2">@lang('Information of') {{$user->fullname}}</h5>

                <form action="{{route('admin.staffs.update',[$user->id])}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('First Name')<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="firstname" value="{{$user->firstname}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Last Name') <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="lastname" value="{{$user->lastname}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Email') <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{$user->email}}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Mobile Number') <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="mobile" value="{{$user->mobile}}">
                            </div>
                        </div>
                    </div>


                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Address') </label>
                                <input class="form-control" type="text" name="address" value="{{@$user->address->address}}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('City') </label>
                                <input class="form-control" type="text" name="city" value="{{@$user->address->city}}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('State') </label>
                                <input class="form-control" type="text" name="state" value="{{@$user->address->state}}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Zip/Postal') </label>
                                <input class="form-control" type="text" name="zip" value="{{@$user->address->zip}}">
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6">
                            <div class="form-group ">
                                <label class="form-control-label font-weight-bold">@lang('Country') </label>
                                <select name="country" class="form-control">
                                    @foreach($countries as $key => $country)
                                    <option value="{{ $key }}" @if($country->country == @$user->address->country ) selected @endif>{{ __($country->country) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>



                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')
                                </button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- hello branch color -->

@endsection