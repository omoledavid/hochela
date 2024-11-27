<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index()
    {
        $pageTitle = 'Subscriber Manager';
        $emptyMessage = 'No subscriber yet.';
        $subscribers = Subscriber::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.subscriber.index', compact('pageTitle', 'emptyMessage', 'subscribers'));
    }

    public function feedBacks()
    {
        $pageTitle = 'Feedback Manager';
        $emptyMessage = 'No feedbacks yet.';
        $feedbacks = Feedback::orderBy('id', 'desc')->paginate(getPaginate());
        return view('admin.feedbacks.index', compact('pageTitle', 'emptyMessage', 'feedbacks'));
    }

    public function sendEmailForm()
    {
        $pageTitle = 'Send Email to Subscribers';
        return view('admin.subscriber.send_email', compact('pageTitle'));
    }

    public function remove(Request $request)
    {
        $request->validate(['subscriber' => 'required|integer']);
        $subscriber = Subscriber::findOrFail($request->subscriber);
        $subscriber->delete();

        $notify[] = ['success', 'Subscriber has been removed'];
        return back()->withNotify($notify);
    }

    public function feedbackRemove(Request $request)
    {
        $request->validate(['feedback' => 'required|integer']);
        $feedback = Feedback::findOrFail($request->feedback);
        $feedback->delete();

        $notify[] = ['success', 'Feedback has been removed'];
        return back()->withNotify($notify);
    }

    public function sendEmail(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'body' => 'required',
        ]);
        $subscriber = Subscriber::first();
        if (!$subscriber) {
            $notify[] = ['error', 'No subscribers to send email'];
            return back()->withAlert();
        }

        $subscribers = Subscriber::all();
        foreach ($subscribers as $subscriber) {
            $receiver_name = explode('@', $subscriber->email)[0];
            sendGeneralEmail($subscriber->email, $request->subject, $request->body, $receiver_name);
        }
        $notify[] = ['success', 'Email will be sent to all subscribers.'];
        return back()->withNotify($notify);
    }
}
