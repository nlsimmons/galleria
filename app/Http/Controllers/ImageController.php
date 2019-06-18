<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    public function editTitle(Request $request, $id)
    {
    	$image = Image::find($id);
    	// Do some validation

    	$image->title = $request->value;
    	$image->save();
    }

    public function getFile($file) 
    {
		return response()->download( storage_path('app/public/images/' . $file . '.jpg') );
	}
}
