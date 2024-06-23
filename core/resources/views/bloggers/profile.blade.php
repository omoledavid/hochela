@extends('bloggers.layouts.app')

@section('panel')

<div class="row mb-none-30">
    <div class="col-xl-3 col-lg-4 col-md-5 mb-30">
        <div class="card b-radius--5 overflow-hidden">
            <div class="card-body p-0">
                <div class="d-flex p-3 bg--primary align-items-center">
                    <div class="avatar avatar--lg">
                        <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $bloggers->image,imagePath()['profile']['user']['size'])}}" alt="@lang('Image')">
                    </div>
                    <div class="pl-3">
                        <h4 class="text--white">{{__($bloggers->fullname)}}</h4>
                    </div>
                </div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Name')
                        <span class="font-weight-bold">{{__($bloggers->fullname)}}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Username')
                        <span class="font-weight-bold">{{__($bloggers->username)}}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Email')
                        <span class="font-weight-bold">{{$bloggers->email}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Mobile')
                        <span class="font-weight-bold">{{$bloggers->mobile}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-9 col-lg-8 col-md-7 mb-30">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-50 border-bottom pb-2">@lang('Profile Information')</h5>

                <form action="{{ route('bloggers.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="image-upload">
                                    <div class="thumb">
                                        <div class="avatar-preview">
                                            <div class="profilePicPreview" style="background-image: url({{ getImage(imagePath()['profile']['user']['path'].'/'.auth()->guard('bloggers')->user()->image,imagePath()['profile']['user']['size']) }})">
                                                <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                        <div class="avatar-edit">
                                            <input type="file" class="profilePicUpload" name="image" id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                            <label for="profilePicUpload1" class="bg--success">@lang('Upload Image')</label>
                                            <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'), @lang('jpg').</b> @lang('Image will be resized into 400x400px') </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('First Name')</label>
                                <input class="form-control" type="text" name="firstname" value="{{ $bloggers->firstname }}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label font-weight-bold">@lang('Last Name')</label>
                                <input class="form-control" type="text" name="lastname" value="{{ $bloggers->lastname }}">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Email')</label>
                                <input class="form-control" type="email" name="email" value="{{ $bloggers->email }}" disabled>
                            </div>
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Mobile')</label>
                                <input class="form-control" type="text" name="mobile" value="{{ $bloggers->mobile }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Address')</label>
                                <input class="form-control" type="text" name="address" value="{{ @$bloggers->address->address }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('State')</label>
                                <input class="form-control" type="text" name="state" value="{{ @$bloggers->address->state }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Zip')</label>
                                <input class="form-control" type="number" min="0" name="zip" value="{{ @$bloggers->address->zip }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('City')</label>
                                <input class="form-control" type="text" name="city" value="{{ @$bloggers->address->city }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-control-label  font-weight-bold">@lang('Country')</label>
                                <input class="form-control" type="text" name="country" value="{{ @$bloggers->address->country }}" disabled>
                            </div>
                        </div>

                    </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Save Changes')</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection

@push('breadcrumb-plugins')
<a href="{{ route('bloggers.change.password') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="fa fa-key"></i>@lang('Change Password')</a>
@endpush