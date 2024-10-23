<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OnBoardingController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function index()
    {
        $user = auth()->user();
        if ($user->onboared == 1) {
            redirect()->route('user.home');
        }
        return view($this->activeTemplate . 'on_boarding');
    }

    public function onboarding(Request $request)
    {
        $user = auth()->user();
        $user->onboarded = 1;
        $user->save();

        $userData = new UserData();
        $userData->user_id = $user->id ?? null;
        $userData->place_type = $request->place_type ?? null;
        $userData->amenities = $request->amenities ?? null;
        $userData->rent = $request->rent ?? null;
        $userData->transportation = $request->transportation ?? null;
        $userData->save();

        $log = $request->rent;
        Log::error('An error occurred 23: ' . $log);
        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }
}
