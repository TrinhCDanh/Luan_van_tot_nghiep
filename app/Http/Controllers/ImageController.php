<?php

namespace App\Http\Controllers;
use App\FileUpload;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
       if($request->get('image'))
       {
          $image = $request->get('image');
          $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          \Image::make($request->get('image'))->save(public_path('images/').$name);
        }

       $image = new FileUpload();
       $image->image = $name;
       $image->save();

       return $name;
        // $file = $request->image;
        // $name =  $file->getClientOriginalName();
        // $file->move(public_path('images'), $name);
        // return 1;
     }
}
