<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Image;
use App\Album;
use App\Slideshow;
use App\Waterfall;

class PageController extends Controller
{
    public function phpinfo()
    {
        return view('phpinfo');
    }

    public function default()
    {
        return redirect()->route('welcome');
    }

    public function main()
    {
        $slides = ( new Slideshow( Image::all() ) )->data;

        return view('main')
            ->with( compact('slides') );
    }

    public function home()
    {
    	if(!Auth::check())
    	{
    		return redirect()->route('login');
    	}

        $user = Auth::user();

        if( ! $user->images->count() && ! $user->albums->count() )
        {
            return view('home_empty');
        }

        $album_slides = new Slideshow( $user->my_albums() );

        $token = $user->api_token;

		return view('home')
            ->with( compact('album_slides', 'token') );
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function album($album_id)
    {
        $album = Album::findOrFail($album_id);
        $user = Auth::user();
        $owner = $album->owner;
        $album_waterfall = new Waterfall( $album->images, 3 );

        if($user && $user->id === $owner->id)
        {
            $album_slides = new Slideshow( $user->my_albums() );
            $includes = compact('album_slides', 'album', 'album_waterfall');
        }
        else
        {
            $includes = compact('album', 'album_waterfall');
        }

        return view('album')
            ->with( $includes );
    }

    public function action(Request $request)
    {
        if( $request->has('delete') )
        {
            Image::destroy($request->delete);
        }

        return $this->home();
    }
}
