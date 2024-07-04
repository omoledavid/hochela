@extends($activeTemplate.'layouts.master')
@section('content')
<div class="row justify-content-center">
    <div class="col-xl-12">
        <div class="card custom--card chat-box">
            <div class="card-header d-flex flex-wrap align-items-center justify-content-between">
                <h4 class="card-title mb-0">
                    @foreach($messages as $message)
                    @if($loop->first)
                    @if($message->sender_id != auth()->user()->id)
                    {{$message->sender->username}}
                    @else
                    {{$message->receiver->username}}
                    @endif
                    @endif
                    @endforeach
                </h4>
            </div>
            <div class="card-body p-0">
                <div class="ps-container">
                    @foreach($messages as $message)
                    @if($message->sender_id != auth()->user()->id)
                    <div class="media media-chat">
                        <img class="avatar" src="{{ getImage(imagePath()['profile']['user']['path'].'/'.auth()->user()->image,imagePath()['profile']['user']['size']) }}" alt="client">
                        <div class="media-body">
                            @if(!empty($message->message))
                            <p>{{$message->message}}</p>
                            @endif
                            @if(!empty($message->file))
                            <div class="media-chat-thumb text-end">
                                <img src="{{getImage(imagePath()['message']['path'].'/'. $message->file)}}" alt="item-banner">
                            </div>
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="media media-chat media-chat-reverse">
                        <img class="avatar" src="{{ getImage(imagePath()['profile']['user']['path'].'/'.$message->sender->image,imagePath()['profile']['user']['size']) }}" alt="client">
                        <div class="media-body">
                            @if(!empty($message->message))
                            <p>{{$message->message}}</p>
                            @endif
                            @if(!empty($message->file))
                            <div class="media-chat-thumb text-end">
                                <img src="{{getImage(imagePath()['message']['path'].'/'. $message->file)}}" alt="item-banner">
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                @foreach($messages as $message)
                @if($loop->last)
                <form class="chat-form" method="POST" action="{{route('user.message.store')}}" enctype="multipart/form-data">
                    @csrf
                    @if($message->sender_id != auth()->user()->id)
                    <input type="hidden" value="{{encrypt($message->sender_id)}}" name="receiver_id">
                    @else
                    <input type="hidden" value="{{encrypt($message->receiver_id)}}" name="receiver_id">
                    @endif
                    <input type="hidden" value="{{encrypt($conversionId)}}" name="conversion_id">
                    <div class="publisher">
                        <div class="chatbox-message-part">
                            <img class="avatar" src="{{ getImage(imagePath()['profile']['user']['path'].'/'.auth()->user()->image,imagePath()['profile']['user']['size']) }}" alt="client">
                            <input class="publisher-input" type="text" name="message" placeholder="@lang('Write something')">
                        </div>
                        <div class="chatbox-send-part d-flex flex-wrap align-items-center">
                            <span class="publisher-btn file-group me-3">
                                <input type="file" name="image" id="data">
                                <label for="data"><i class="fa fa-paperclip"></i></label>
                            </span>
                            <button type="submit" class="btn--base btn-md">@lang('Submit')</button>
                        </div>
                    </div>
                </form>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@push('script')
<script>
    $('[readonly]').on('focus', function() {
        $(this).parents('.form-group').append('<span class="text--danger error-message">@lang("Sorry! you can\'t change this field")<span>');
    });

    $('[readonly]').on('focusout', function() {

        $(this).parents('.form-group').find('.error-message').remove();

    });
</script>
@endpush