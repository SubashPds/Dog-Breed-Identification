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

        // Run the Python script to predict the dog breed
        $output = shell_exec("C:\Python311\python.exe D:\Rupesh_dai\Laravel-8-Blog-Tutorial-up-to-Deployment\breed_prediction.py \"$imgPath\"");
        
        // Pass the correct path of the image to the view
        $imagePath = 'predictedImage/'.$originalName;
        return view('dog_breed_form', ['breed' => $output, 'image' => $imagePath]);
    }
}

