<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class DogBreedIdentifierController extends Controller
{
    public function predict(Request $request){
        $originalName = $request->image->getClientOriginalName();
        $relativePath = $request->image->storeAs('images', $originalName);       
        $imgPath = storage_path('app/' . $relativePath);
        $output= shell_exec("C:\Python311\python.exe D:\Rupesh_dai\Laravel-8-Blog-Tutorial-up-to-Deployment\breed_prediction.py \"$imgPath\"");
        return view('dog_breed_form', ['breed' => $output]);

    }
    
}
