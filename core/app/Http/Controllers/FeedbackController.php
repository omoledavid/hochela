<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:255',
        ]);

        Feedback::create([
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return response()->json(['message' => 'Feedback saved successfully'], 200);
    }
}
