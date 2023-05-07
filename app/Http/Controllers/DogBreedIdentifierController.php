<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DogBreedIdentifierController extends Controller
{
    public function predict(Request $request)
    {
        // Store the uploaded image in the public directory
        $originalName = $request->image->getClientOriginalName();
        $relativePath = $request->image->storeAs('images', $originalName);
        $imgPath = storage_path('app/' . $relativePath);
        $request->file('image')->move(public_path('predictedImage'), $originalName);

        $output = shell_exec("/usr/bin/python3 /home/rupesh/Desktop/Dog/Dog-Breed-Identification/breed_prediction.py " . escapeshellarg($imgPath) . " 2>&1");

        $imagePath = 'predictedImage/' . $originalName;
        return view('dog_breed_form', ['breed' => $output, 'image' => $imagePath]);
    }
}
