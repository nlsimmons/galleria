<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\Slideshow;

class AlbumController extends Controller
{
    public function editTitle(Request $request, $id)
    {
    	$image = Album::find($id);
    	// Do some validation

    	$image->title = $request->value;
    	$image->save();
    }

    public function show($id)
    {
    	$images = Album::find($id)->images;
    	$image_slides = new Slideshow($images);

        // return $image_slides;
        // return $images;
    	return view('album')
    		->with( compact('image_slides') );
    }
}
