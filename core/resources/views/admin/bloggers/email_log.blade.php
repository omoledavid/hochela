@extends('admin.layouts.app')
@section('panel')
<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10 ">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Owner')</th>
                                <th>@lang('Sent')</th>
                                <th>@lang('Mail Sender')</th>
                                <th>@lang('Subject')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td data-label="@lang('Owner')">
                                    <span class="font-weight-bold">{{ $log->owner->fullname }}</span>
                                    <br>
                                    <span class="small">
                                        <a href="{{ route('admin.owners.detail', $log->owner_id) }}"><span>@</span>{{ $log->owner->username }}</a>
                                    </span>
                                </td>
                                <td data-label="@lang('Sent')">
                                    {{ showDateTime($log->created_at) }}
                                    <br>
                                    {{ $log->created_at->diffForHumans() }}
                                </td>
                                <td data-label="@lang('Mail Sender')">
                                    <span class="font-weight-bold">{{ __($log->mail_sender) }}</span>
                                </td>
                                <td data-label="@lang('Subject')">{{ __($log->subject) }}</td>
                                <td data-label="@lang('Action')">
                                    <a href="{{ route('admin.owners.email.details',$log->id) }}" class="icon-btn btn--primary" target="_blank"><i class="fas fa-desktop"></i></a>
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
                {{ paginateLinks($logs) }}
            </div>
        </div><!-- card end -->
    </div>
</div>
@endsection

@push('breadcrumb-plugins')
{{-- <a href="{{ route('admin.owners.detail', $log->owner_id) }}" class="btn btn--info"><i class="las la-user"></i> {{ $bloggers->fullname }}</a> --}}
@endpush