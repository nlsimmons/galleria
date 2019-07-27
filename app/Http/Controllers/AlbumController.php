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
        // $album->title = $request->title;
        $album->owner_id = Auth::id();
        $album->save();

        if( !empty($request->_api) )
            return $album->id;

        return redirect()->route('album', ['id' => $album->id]);
    }

    public function upload(Request $request, $id)
    {
        if(!Auth::check())
        {
            abort(403, 'User not logged in');
        }

        $new_image = Image::upload($request->image, Auth::id(), $id);

        return $new_image;
    }

    /* * * * */

    public function editTitle(Request $request, $id)
    {
    	$image = Album::find($id);
    	// Do some validation

    	$image->title = $request->value;
    	$image->save();

        return 'success';
    }

    public function delete($id)
    {
        Album::destroy($id);

        return redirect()->route('home');
    }

    public function action($album_id, Request $request)
    {
        $album = Album::find($album_id);

        if( Auth::id() !== $album->owner->id )
        {
            throw new Exception('You are not authorized to access this resource.');
        }

        switch($request->action)
        {
            case 'delete':
                $this->delete($album_id);
                break;
        }

        return redirect()->route('home');
    }
}
