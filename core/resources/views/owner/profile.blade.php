@extends('owner.layouts.app')

@section('panel')

    <div class="row mb-none-30">
        <div class="col-xl-3 col-lg-4 col-md-5 mb-30">
            <div class="card b-radius--5 overflow-hidden">
                <div class="card-body p-0">
                    <div class="d-flex p-3 bg--primary align-items-center">
                    <div class="avatar avatar--lg">
                            <img src="{{ getImage(imagePath()['profile']['user']['path'].'/'. $owner->image,imagePath()['profile']['user']['size'])}}" alt="@lang('Image')">
                        </div>
                        <div class="pl-3">
                            <h4 class="text--white">{{__($owner->fullname)}}</h4>
                        </div>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Name')
                            <span class="font-weight-bold">{{__($owner->fullname)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Username')
                            <span  class="font-weight-bold">{{__($owner->username)}}</span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Email')
                            <span  class="font-weight-bold">{{$owner->email}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Mobile')
                            <span  class="font-weight-bold">{{$owner->mobile}}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-8 col-md-7 mb-30">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Profile Information')</h5>

                    <form action="{{ route('owner.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview" style="background-image: url({{ getImage(imagePath()['profile']['user']['path'].'/'.auth()->guard('owner')->user()->image,imagePath()['profile']['user']['size']) }})">
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
                                    <input class="form-control" type="text" name="firstname" value="{{ $owner->firstname }}" >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Last Name')</label>
                                    <input class="form-control" type="text" name="lastname" value="{{ $owner->lastname }}" >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Email')</label>
                                    <input class="form-control" type="email" name="email" value="{{ $owner->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Mobile')</label>
                                    <input class="form-control" type="text" name="mobile" value="{{ $owner->mobile }}" disabled>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('About Me')</label>
                                    <textarea class="form-control" type="text" name="about_me" value="{{ @$owner->about_me }}" >{{ @$owner->about_me }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Address')</label>
                                    <input class="form-control" type="text" name="address" value="{{ @$owner->address->address }}" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('State')</label>
                                    <input class="form-control" type="text" name="state" value="{{ @$owner->address->state }}" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Zip')</label>
                                    <input class="form-control" type="number" min="0" name="zip" value="{{ @$owner->address->zip }}" >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('City')</label>
                                    <input class="form-control" type="text" name="city" value="{{ @$owner->address->city }}" >
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Country')</label>
                                    <input class="form-control" type="text" name="country" value="{{ @$owner->address->country }}" disabled>
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
    <a href="{{ route('owner.change.password') }}" class="btn btn-sm btn--primary box--shadow1 text--small" ><i class="fa fa-key"></i>@lang('Change Password')</a>
@endpush
