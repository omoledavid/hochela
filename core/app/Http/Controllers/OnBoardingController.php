<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        if ($user->onboarded === 1) {
            return redirect()->route('user.home');
        }
        return view($this->activeTemplate . 'on_boarding');
    }

    public function agent()
    {
        $user = auth()->user();
        return view($this->activeTemplate . 'agent_onboarding');

    }

    public function propertyUpload(Request $request)
    {
        $location = Location::first();
        $propertyTypes = PropertyType::all();
        $closestMatch = null;
        $shortestDistance = -1;

        foreach ($propertyTypes as $type) {
            $levenshteinDistance = levenshtein(strtolower(trim($request->place_type)), strtolower(trim($type->name)));

            if ($shortestDistance === -1 || $levenshteinDistance < $shortestDistance) {
                $closestMatch = $type;
                $shortestDistance = $levenshteinDistance;
            }
        }

        if ($closestMatch && $shortestDistance <= 3) { // Adjust distance threshold as needed
            $propertyType = $closestMatch;
        } else {
            abort(404, 'Property type not found');
        }


        $property = new Property();
        $status = 0;
        $oldImage = null;
        $notification = 'Property added successfully';
        $filename = '';
        $multipleImages = [];


        $path = imagePath()['property']['path'];
        $size = imagePath()['property']['size'];

        if ($request->hasFile('file-upload')) {
            $multipleImages = []; // Initialize the array to hold multiple image URLs
            $notify = []; // Initialize notification array
            try {
                // Retrieve the files from the request and ensure it's always an array
                $files = $request->file('file-upload');
                if (!is_array($files)) {
                    $files = [$files];
                }

                // Store the first file separately
                $firstFile = array_shift($files); // Take the first file
                $filename = uploadImage($firstFile, $path, $size, $oldImage);

                // Process remaining files
                foreach ($files as $file) {
                    try {
                        $filenames = uploadImage($file, $path, $size);
                        array_push($multipleImages, $filenames);
                    } catch (\Exception $exp) {
                        $notify[] = ['error', 'Some images could not be uploaded.'];
                        \Log::error("Image upload failed: " . $exp->getMessage()); // Log error for debugging
                    }
                }

                // Check if there were any upload errors
                if (!empty($notify)) {
                    return back()->withNotify($notify);
                }

            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                \Log::error("Primary image upload failed: " . $exp->getMessage()); // Log main exception
                return back()->withNotify($notify);
            }
        }


        $property->name = $request->name;
        $property->property_type_id = $propertyType->id;
        $property->owner_id = Auth::guard('owner')->id();
        $property->location_id = $location->id;
        $property->phone = $request->phone ?? null;
        $property->phone_call_time = $request->phone_call_time ?? null;
        $property->discount = number_format($request->discount, 2);
        $property->map_url = $request->map_url ?? null;
        $property->description = $request->description;
        $property->image = $filename;
        $property->images = $multipleImages;
        $property->star = $request->star ?? 3;
        $property->extra_features = $request->extra_features ?? null;
        $property->status = $status;
        $property->available_rooms = $request->available_rooms ?? 1;
        $property->property_amount = $request->property_amount;
        $property->google_link = $request->google_link ?? null;
        $property->apartment_location = $request->location;
        $property->save();
        $notify[] = ['success', $notification];
        return response()->json(['success' => 'Form submitted successfully!', 'data' => $request->all()]);
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
