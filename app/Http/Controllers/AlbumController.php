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
    public function __construct(Request $request)
    {
        if( $user = Auth::guard('api')->user() )
            Auth::login($user);
    }

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

    public function get(Request $request)
    {
        $albums = Auth::user()->albums;
        $albums->each(function($item, $key){
            if( empty($item->cover_image) && $item->images->count() )
            {
                $image = $item->images->random();
                $item->cover_image = url( $image->uri(150) );
            }
        });

        return $albums;
    }

    public function editTitle(Request $request, $id)
    {
    	$image = Album::find($id);
    	// Do some validation

    	$image->title = $request->title;
    	$image->save();

        return 'success';
    }

    public function delete(Request $request, $id)
    {
        try {
            Album::destroy($id);
        } catch( \Exception $e ) {
            throw $e;
        }

        return 'success';
    }

    /* * * * * * * */

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
