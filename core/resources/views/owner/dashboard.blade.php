@extends('owner.layouts.app')

@section('panel')

    <div class="col-md-12">
        @if ($user->image == null)
            <div class="alert border border--warning" role="alert">
                <div class="alert__icon d-flex align-items-center text--warning"><i class="fas fa-user"></i></div>
                <p class="alert__message">
                    <span class="fw-bold">@lang('Update Profile')</span><br>
                    <small><i>@lang('For better identity, Please update your') <a href="{{ route('owner.profile') }}"
                                class="link-color">@lang('Profile')</a></i>
                        @lang('to enable client reach out to your.')</small>
                </p>
            </div>
        @endif
        @if ($user->kv == 0)
            <div class="alert border border--info" role="alert">
                <div class="alert__icon d-flex align-items-center text--info"><i class="fas fa-file-signature"></i>
                </div>
                <p class="alert__message">
                    <span class="fw-bold">@lang('KYC Verification Required')</span><br>
                    <small><i>@lang('Please submit the required KYC information to verify yourself. Otherwise, you can\'t upload your property.') <a href="{{ route('owner.kyc.form') }}"
                                class="link-color">@lang('Click here')</a> @lang('to submit KYC information').</i></small>
                </p>
            </div>
        @elseif($user->kv == 2)
            <div class="alert border border--warning" role="alert">
                <div class="alert__icon d-flex align-items-center text--warning"><i class="fas fa-user-check"></i></div>
                <p class="alert__message">
                    <span class="fw-bold">@lang('KYC Verification Pending')</span><br>
                    <small><i>@lang('Your submitted KYC information is pending for admin approval. Please wait till that.') <a href="{{ route('owner.kyc.data') }}"
                                class="link-color">@lang('Click here')</a> @lang('to see your submitted information')</i></small>
                </p>
            </div>
        @endif
        <!-- dashboard-w1 end -->
    </div>
    @if ($general->aw == 1)
        <div class="row mb-none-30">
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-wallet"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ showAmount($widget['balance']) }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Available Balance')</span>
                        </div>
                        <a href="{{ route('owner.withdraw') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Withdraw Money')</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $widget['total_properties'] }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Total Properties')</span>
                        </div>
                        <a href="{{ route('owner.property.index') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--teal b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $widget['total_rooms'] }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Total Available Rooms')</span>
                        </div>
                        <a href="{{ route('owner.property.index') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View Properties')</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--green b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $widget['total_appointment'] }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Booked Appointment')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif($general->aw == 0)
        <div class="row mb-none-30">
            <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $widget['total_properties'] }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Total Properties')</span>
                        </div>
                        <a href="{{ route('owner.property.index') }}"
                            class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--teal b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $widget['total_rooms'] }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Total Available Rooms')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
                <div class="dashboard-w1 bg--green b-radius--10 box-shadow">
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="details">
                        <div class="numbers">
                            <span class="amount">{{ $widget['total_appointment'] }}</span>
                        </div>
                        <div class="desciption">
                            <span class="text--small">@lang('Booked Appointment')</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-4">
        <div class="col-lg-12">
            <h6 class="mb-3">@lang('Bookings')</h6>
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                                <tr>
                                    <th scope="col">@lang('Date')</th>
                                    <th scope="col">@lang('Ttime')</th>
                                    <th scope="col">@lang('User')</th>
                                    <th scope="col">@lang('Status')</th>
                                    <th scope="col">@lang('Action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookings as $booking)
                                    <tr>
                                        <td data-label="@lang('date')">
                                            {{ $booking->getCreatedAtAttribute($booking->date_time)->format('M d , Y') }}
                                        </td>
                                        <td data-label="@lang('time')">
                                            {{ $booking->getCreatedAtAttribute($booking->date_time)->format('h:i a') }}
                                        </td>
                                        <td data-label="@lang('User')">
                                            {{$booking->user->fullname;}}
                                        </td>
                                        <td data-label="@lang('Status')">
                                            @if ($booking->status == 1)
                                                <span class="badge badge--success">
                                                    @lang('Accepted')
                                                </span>
                                            @else
                                                <span class="badge badge--warning">
                                                    @lang('Pending')
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!$booking->status == 1)
                                                <a href="javascript:void(0)"
                                                    class="icon-btn {{ $booking->status == 0 ? 'btn--warning' : ($booking->status == 1 ? 'btn--success' : 'btn--danger') }} mr-1 approveOrReject"
                                                    data-original-title="{{ $booking->status == 0 ? 'Approve/Reject' : ($booking->status == 2 ? 'Reject' : 'Approve') }}"
                                                    data-toggle="tooltip"
                                                    data-url="{{ route('owner.conversation.check', $booking->id) }}">
                                                    @if ($booking->status == 0)
                                                        <i class="la la-spinner"></i>
                                                    @elseif($booking->status == 2)
                                                        <i class="la la-times"></i>
                                                    @else
                                                        <i class="la la-check"></i>
                                                    @endif
                                                </a>
                                            @else
                                                <a class="icon-btn {{ $booking->status == 0 ? 'btn--warning' : ($booking->status == 1 ? 'btn--success' : 'btn--danger') }} mr-1 "
                                                    href="javascript:void()">
                                                    @if ($booking->status == 0)
                                                        <i class="la la-spinner"></i>
                                                    @elseif($booking->status == 2)
                                                        <i class="la la-times"></i>
                                                    @else
                                                        <i class="la la-check"></i>
                                                    @endif
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                    <tr>
                                        <td class="text-center" colspan="100%">
                                            @lang('No Booking Found')
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="d-widget d-flex flex-wrap align-items-center rounded-3">
                <label for="lastname" class="col-form-label">@lang('My Referral Link'):</label>
                <div class="input-group">
                    <input type="url" id="ref"
                        value="{{ route('home') . '?reference=' . $user->username }}"
                        class="form--control bg-transparent" readonly>
                    <button type="button" class="input-group-text bg--base copybtn border-0 text-white"><i
                            class="fa fa-copy"></i> &nbsp; @lang('Copy')</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Status MODAL --}}
    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('Update Status')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <p class="text-muted">@lang('Are you sure to change status?')</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('No')</button>
                        <button type="submit" class="btn btn--danger deleteButton">@lang('Yes')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Approve MODAL --}}
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">@lang('Mark as approve or reject!')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <form method="post" action="">
                    @csrf

                    <div class="modal-body">
                        <p class="text-muted">@lang('Are you sure to approve or reject booking?')</p>
                    </div>

                    <input type="hidden" name="approve" class="approveInput">

                    <div class="modal-footer">
                        <button type="submit" class="btn btn--warning"><i
                                class="las la-ban"></i>@lang('Reject')</button>
                        <button type="submit" class="btn btn--success approveButton"><i
                                class="las la-check"></i>@lang('Approve')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            'use strict'

            $('.delete').on('click', function(event) {
                event.preventDefault();
                const modal = $('#deletenews');
                modal.find('form').attr('action', $(this).data('url'))
                modal.modal('show');
            })

            //Status
            $('.statusBtn').on('click', function() {
                var modal = $('#statusModal');
                var url = $(this).data('url');

                modal.find('form').attr('action', url);
                modal.modal('show');
            });

            //Approve
            $('.approveOrReject').on('click', function() {
                var modal = $('#approveModal');
                var url = $(this).data('url');

                modal.find('form').attr('action', url);
                modal.modal('show');
            });
            $('.approveButton').on('click', function() {
                $('.approveInput').val(1);
            });

            //Filter category
            $(".categorySelect").on("change", function() {
                if ($(this).val() == '') {
                    return false;
                }
                window.location.href = $('.categorySelect option:selected').data('url');
            });
        })
    </script>
@endpush
