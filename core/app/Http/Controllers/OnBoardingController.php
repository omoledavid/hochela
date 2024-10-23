<?php

namespace App\Http\Controllers;

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
        return view($this->activeTemplate . 'on_boarding');
    }

    public function onboarding(Request $request)
    {
        $log = $request->rent;
        Log::error('An error occurred 23: ' . $log);
        return response()->json(['success' => true, 'message' => 'Data saved successfully!']);
    }
}
