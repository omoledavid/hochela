@extends('admin.layouts.app')
@section('panel')
    <div class="row">
        <div class="card col-md-12 p-0">
            <div class="card-header bg--primary">
                @lang('Blog Posts Post')
            </div>
            <div class="card-body">
                <form action="{{ route('admin.news.create') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="row">
                                <div class="form-group col-md-12 mt-3">
                                    <div class="image-upload">
                                        <div class="thumb">
                                            <div class="avatar-preview">
                                                <div class="profilePicPreview"
                                                     style="background-image: url({{ getImage('/', imagePath()['news']['size']) }})">
                                                    <button type="button" class="remove-image"><i class="fa fa-times"></i></button>
                                                </div>
                                            </div>
                                            <div class="avatar-edit">
                                                <input type="file" class="profilePicUpload" name="image"
                                                       id="profilePicUpload1" accept=".png, .jpg, .jpeg">
                                                <label for="profilePicUpload1" class="bg--primary">@lang('Upload Image')</label>
                                                <small class="mt-2 text-facebook">@lang('Supported files'): <b>@lang('jpeg'),
                                                        @lang('jpg')</b>. @lang('Image will be resized into')
                                                    {{ imagePath()['news']['size'] }}@lang('px'). </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row addVideo">
                                <div class="form-group col-md-12">
                                    <label for="">@lang('Category') <code>**</code> </label>
                                    <select name="category" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">@lang('Blog Posts Title') <code>**</code></label>
                                    <input type="text" class="form-control" name="title" required placeholder="@lang('Blog Posts Title')">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">@lang('Author\'s name') <code>**</code></label>
                                    <input type="text" class="form-control" name="author" required placeholder="@lang('Author\'s name')">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName" class="">@lang('Trending')</label>
                                    <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="-success"
                                           data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Yes')"
                                           data-off="@lang('No')" name="trending">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName" class="">@lang('Must Read')</label>
                                    <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="-success"
                                           data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Yes')"
                                           data-off="@lang('no')" name="must_read">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputName" class="">@lang('Add Video')</label>
                                    <input type="checkbox" data-width="100%" data-height="40px" data-onstyle="-success"
                                           data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Yes')"
                                           data-off="@lang('no')" name="video">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="tags">@lang('Tags')</label>
                                    <select name="tags[]" id="tags" class="form-control select2-auto-tokenize" multiple required>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="">@lang('Blog Posts Short Description') <code>**</code></label>
                            <textarea name="short_description" cols="30" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-md-12 newsDescription">
                            <label for="">@lang('Blog Posts Description') <code>**</code></label>
                            <textarea name="description" cols="30" rows="15" id="summernote"></textarea>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn--primary w-100">@lang('Create Blog Posts')</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('breadcrumb-plugins')
    <a href="{{ url()->previous() == url()->current() ? route('admin.news.index') :  url()->previous()}}" class="btn btn--primary float-sm-right ml-lg-3 mb-3 text-white"> <i
            class="las la-backward"></i> @lang('Go Back')</a>
@endpush
@push('script')
    <script>
        $(function() {
            'use strict'

            $(document).on('change', ".profilePicUpload",function() {
                proPicURL(this);
            });

            var video_input = `<div class="form-group col-md-12 hideInput">
                                    <label for="">@lang('You Tube Embed Link')</label>
                                    <input type="text" name="video_link" class="form-control" placeholder="https://www.youtube.com/embed/g--C2srD_5I">
                                </div>`;

            $('input[name=video]').on('change',function() {
                if($(this).is(':checked')){
                    $('.addVideo').append(video_input);
                }else{
                    $('.hideInput').remove();
                }
            })
        })
    </script>
@endpush
