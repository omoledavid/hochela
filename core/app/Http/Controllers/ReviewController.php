<?php

namespace App\Http\Controllers;

use App\Models\Agent_review;
use App\Models\BookedProperty;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Request $request)
    {
        $request->validate([
            'rating' => 'required|numeric|gt:0',
            'review' => 'required'
        ]);

        $acquired = BookedProperty::where('user_id', auth()->id())->where('owner_id', $request->agent_id)->first();
        if (!$acquired) {
            $notify[] = ['error', 'You haven\'t acquired a property yet'];
            return back()->withNotify($notify);
        }

        if (auth()->user()->reviewed()) {
            $notify[] = ['error', 'You have already reviewed once'];
            return back()->withNotify($notify);
        }

        if (auth()->id() == $request->agent_id) {
            $notify[] = ['error', 'You can not review yourself'];
            return back()->withNotify($notify);
        }

        $review = new Agent_review();
        $review->user_id = auth()->id();
        $review->agent_id = $request->agent_id;
        $review->stars = $request->rating;
        $review->review = $request->review;
        $review->save();

        $notify[] = ['success', 'Review has been submitted'];
        return back()->withNotify($notify);
    }
}
