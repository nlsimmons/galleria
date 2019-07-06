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
        $album = Album::find($id);
        $album_title = $album->title;
    	$images = $album->images;
    	$image_slides = new Slideshow($images);

    	return view('album')
    		->with( compact('image_slides', 'id', 'album_title') );
    }

    private function delete($id)
    {
        Album::destroy($id);
    }

    public function action($album_id, Request $request)
    {
        switch($request->action)
        {
            case 'delete':
                $this->delete($album_id);
                break;
        }

        return redirect()->route('home');
    }
}
