<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $url = asset('core/public/uploads/' . $filename);
        return response()->json(['url' => $url]);
    }
    return response()->json(['error' => 'No file uploaded'], 400);

    
}
}
