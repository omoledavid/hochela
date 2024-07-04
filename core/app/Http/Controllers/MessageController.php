<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Conversation;
use App\Models\Messages;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $pageTitle = "Inbox";
        $user = Auth::user();
        $conversions = Conversation::where('sender_id', $user->id)->orWhere('receiver_id', $user->id)->latest()->with('receiver', 'messages')->get();
        return view($this->activeTemplate . 'user.messages.index', compact('pageTitle', 'conversions'));
    }
    public function chat($conversionId)
    {
        $conversions = Conversation::findOrFail($conversionId);
        $pageTitle = "Chat List";
        $messages = Messages::where('conversion_id', $conversions->id)->with('sender', 'receiver')->get();
        return view(activeTemplate() . 'user.messages.view', compact('pageTitle', 'messages', 'conversionId'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->id != $request->recevier_id) {
            $request->validate([
                'subject' => 'required|max:250',
                'message' => 'required|max:500',
                'recevier_id' => 'required|exists:owners,id'
            ]);
            $startedChat = Conversation::where('sender_id', $user->id)->where('receiver_id', $request->recevier_id)->first();
            if ($startedChat) {
                $notify[] = ['error', 'You already started a conversaction with the property agent'];
                return back()->withNotify($notify);
            }
            $conversion = new Conversation();
            $conversion->sender_id = $user->id;
            $conversion->receiver_id = $request->recevier_id;
            $conversion->save();

            $message = new Messages();
            $message->conversion_id = $conversion->id;
            $message->sender_id = $user->id;
            $message->receiver_id = $request->recevier_id;
            $message->subject = $request->subject;
            $message->message = $request->message;
            $message->save();
            $notify[] = ['success', 'Message Sent'];
            return back()->withNotify($notify);
        }
        $notify[] = ['error', "it's You"];
        return back()->withNotify($notify);
    }

    public function messageStore(Request $request)
    {
        $conversionId = Conversation::findOrFail(decrypt($request->conversion_id));
        $receiver = Owner::findOrFail(decrypt($request->receiver_id));
        if ($request->image == null) {
            $request->validate(['message' => 'required|max:500']);
        } elseif ($request->message == null) {
            $request->validate(['image' => 'required|mimes:jpeg,jpg,png|max:100000']);
        } elseif ($request->message && $request->image) {
            $request->validate([
                'message' => 'required|max:500',
                'image' => 'required|mimes:jpeg,jpg,png|max:100000'
            ]);
        }
        $message = new Messages();
        $message->conversion_id = $conversionId->id;
        $message->sender_id = auth()->user()->id;
        $message->receiver_id = $receiver->id;
        $message->message = $request->message;
        $path = imagePath()['message']['path'];
        $size = imagePath()['message']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
            $message->file = $filename;
        }
        $message->save();
        $notify[] = ['success', 'Message Sent'];
        return back()->withNotify($notify);
    }
    public function booking(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $request->validate([
                'time' => 'required',
                'agent_id' => 'required'
            ]);
            $oldBookings = Booking::where('user_id', $user->id)->where('agent_id', $request->agent_id)->first();
            if ($oldBookings) {
                $notify[] = ['error', 'You already have a meeting with this Agent'];
                return back()->withNotify($notify);
            }
            $booking = new Booking();
            $booking->user_id = $user->id;
            $booking->agent_id = $request->agent_id;
            $booking->date_time = $request->time;
            $booking->save();
            $notify[] = ['success', 'Booking date and time Sent'];
            return back()->withNotify($notify);
        }
        $notify[] = ['error', "Something is wrong somewhere"];
        return back()->withNotify($notify);
    }
}
