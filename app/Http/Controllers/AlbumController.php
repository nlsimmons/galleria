<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use ImageManager;
use App\Image;
use App\Album;
use App\Slideshow;

class AlbumController extends Controller
{
    public function new(Request $request)
    {
        if(!Auth::check())
        {
            throw new Exception('User not logged in');
        }

        $album = new Album;
        $album->title = $request->title;
        $album->owner_id = Auth::id();
        $album->save();

        return ['id' => $album->id];
    }

    public function upload(Request $request, $id)
    {
        if(!Auth::check())
        {
            throw new Exception('User not logged in');
        }

        $new_image = Image::upload($request->image, Auth::id(), $id);

        return $new_image->url;
        return 'success';

        // $image = ImageManager::make( $request->image );


        // return $image;
    }

    /* * * * */

    public function editTitle(Request $request, $id)
    {
    	$image = Album::find($id);
    	// Do some validation

    	$image->title = $request->value;
    	$image->save();
    }

    public function show($id)
    {
        $album = Album::findOrFail($id);
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
