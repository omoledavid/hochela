<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Amenity;
use App\Models\GeneralSetting;
use App\Models\Location;
use App\Models\Property;
use App\Models\PropertyType;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function properties()
    {
        $pageTitle = 'All Properties';
        $user = Auth::guard('owner')->user();
        $general = GeneralSetting::first();
        if ($user->image == null && $general->pfr == 1) {
            $notify[] = ['error', 'Update Profile to upload property'];
            return redirect()->route('owner.dashboard')->with('notify', $notify);
        }
        if ($user->kv == 0 && $general->kr == 1) {
            $notify[] = ['error', 'Update KYC to upload property'];
            return redirect()->route('owner.dashboard')->with('notify', $notify);
        }
        $emptyMessage = 'No property found';
        $properties = Property::with('propertyType', 'location', 'rooms', 'roomCategories')->where('owner_id', Auth::guard('owner')->id())->orderBy('id', 'DESC')->paginate(getPaginate());
        return view('owner.property.index', compact('pageTitle', 'emptyMessage', 'properties'));
    }

    public function create()
    {
        $pageTitle = 'Create New Property';
        $propertyTypes = PropertyType::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $amenities = Amenity::where('status', 1)->get();
        return view('owner.property.create', compact('pageTitle', 'propertyTypes', 'locations', 'amenities'));
    }

    public function edit($id)
    {
        $pageTitle = 'Update Property';
        $property = Property::where('owner_id', Auth::guard('owner')->id())->findOrFail($id);
        $propertyTypes = PropertyType::where('status', 1)->get();
        $locations = Location::where('status', 1)->get();
        $amenities = Amenity::where('status', 1)->get();
        return view('owner.property.edit', compact('pageTitle', 'property', 'propertyTypes', 'locations', 'amenities'));
    }

    public function saveProperty(Request $request, $id = 0)
    {
        $request->validate([
            'name' => 'required',
            'image' => [
                'sometimes',
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])
            ],
            'property_type' => 'required',
            'apartment_location' => 'required',
            'google_link' => 'required',
            'available_rooms' => 'required|numeric',
            'property_amount' => 'required|numeric',
            'phone' => 'nullable',
            'phone_call_time' => 'nullable',
            'discount' => 'sometimes|numeric|min:0',
            'star' => 'required|numeric|min:1',
            'extra_features' => 'sometimes|array',
            'amenity' => 'sometimes|array',
            'amenity.*' => 'required',
            'images' => 'sometimes|array',
            'images.*' => ['image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'change_images' => 'sometimes|array',
            'change_images.*' => ['image', new FileTypeValidate(['jpeg', 'jpg', 'png'])],
        ]);

        $property = new Property();
        $status = 0;
        $oldImage = null;
        $notification = 'Property added successfully';
        $filename = '';
        $multipleImages = [];


        $path = imagePath()['property']['path'];
        $size = imagePath()['property']['size'];

        if ($id) {
            $property = Property::findOrFail($id);
            $status = $request->status ? 1 : 0;
            $oldImage = $property->image;
            $notification = 'Property updated successfully';
            $filename = $request->hasFile('image') ? '' : $property->image;
            $multipleImages = $property->images;

            if ($request->old_images) {
                $oldImages = explode(',', $request->old_images);
                $multipleImages = array_values(array_intersect($multipleImages, $oldImages));
            }

            if ($request->hasFile('change_images')) {
                foreach ($request->change_images as $key => $change_image) {
                    try {
                        $filename = uploadImage($change_image, $path, $size);
                        array_splice($multipleImages, $key, 0, $filename);
                    } catch (\Exception $exp) {
                        $notify[] = ['error', 'Image could not be uploaded.'];
                        return back()->withNotify($notify);
                    }
                }
            }
        }

        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size, $oldImage);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        if ($request->hasFile('images')) {
            for ($i = 0; $i < count($request->images); $i++) {
                try {
                    $filenames = uploadImage($request->images[$i], $path, $size);
                    array_push($multipleImages, $filenames);
                } catch (\Exception $exp) {
                    $notify[] = ['error', 'Image could not be uploaded.'];
                    return back()->withNotify($notify);
                }
            }
        }

        $property->name = $request->name;
        $property->property_type_id = $request->property_type;
        $property->owner_id = Auth::guard('owner')->id();
        $property->location_id = $request->location;
        $property->phone = $request->phone;
        $property->phone_call_time = $request->phone_call_time;
        $property->discount = $request->discount;
        $property->map_url = $request->map_url;
        $property->description = $request->description;
        $property->image = $filename;
        $property->images = $multipleImages;
        $property->star = $request->star;
        $property->extra_features = $request->extra_features;
        $property->status = $status;
        $property->available_rooms = $request->available_rooms;
        $property->property_amount = $request->property_amount;
        $property->google_link = $request->google_link;
        $property->apartment_location = $request->apartment_location;
        $property->save();
        $notify[] = ['success', $notification];
        return back()->withNotify($notify)->withInput();
    }
}
