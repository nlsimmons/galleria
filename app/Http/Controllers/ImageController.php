<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Image;
use App\Album;

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

    private function delete($id)
    {
        Image::destroy($id);
    }

    public function action($image_id, Request $request)
    {
        switch($request->action)
        {
            case 'delete':
                $this->delete($image_id);
                break;
        }

        return redirect()->route('album', ['id' => $request->album_id] );
    }

    public function upload(Request $request, $album)
    {
        if(!Auth::check())
        {
            return redirect()->route('welcome');
        }

        $user = Auth::user();

        if( $request->album == 'new' )
        {
            $album = new Album;
            $album->owner = $user->id;
            $album->save();
            $album_id = $album->id;

            $user->my_albums()->save($album);
        }
        else
        {
            $album = Album::find($request->album);
            $album_id = $album->id;
        }

        $files = $request->file('images');

        foreach( $files as $file )
        {
            $image = Image::upload( $file, Auth::id() );
            $image->owner = $user->id;
            $image->save();

            $album->images()->save($image);
            $user->my_images()->save($image);
        }

        return redirect()->route('album', ['id' => $album_id]);
    }
}
