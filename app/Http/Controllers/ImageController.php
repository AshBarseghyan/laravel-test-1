<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function upload(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        //check if image is valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        try {
            //Get image from request
            $image = $request->file('image');

            //Set image name
            $input['imagename'] = time() . '_' . str()->random(5) . '.' . $image->getClientOriginalExtension();

            //Set image path
            $destinationPath = public_path('/images');

            //Move image to destination path
            $img = Image::make($image->getRealPath());

            //Resize image
            $img->resize(100, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath . '/' . $input['imagename']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload image.'], 401);
        }

        return response()->json(['success' => 'You have successfully upload image.']);
    }
}
