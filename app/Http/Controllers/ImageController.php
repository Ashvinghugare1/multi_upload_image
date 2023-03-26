<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ImageController extends Controller
{
    public function index()
    {
        return view('imageUpload');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required',
            'images' => 'required|max:2048',
        ]);
        $image = [];
        if($request->images){
            foreach($request->images as $key => $image){
                $imageName = time().rand(1,99).'.'.$image->extension();
                $image->move(public_path('images'), $imageName);

                $images[]['name'] = $imageName;
            }
        }
        foreach($images as $key => $image){
            Image::create($image);
        }
        return back()->with('success', 'image uploaded succesfully')->with('images',$images);
    }
}


// $image->storeAs('images', $imageName);
// storage/app/images/file.png

// $image->move(public_path('images'), $imageName);
// public/images/file.png