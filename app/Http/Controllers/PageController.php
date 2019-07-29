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

    public function welcome()
    {
        return view('welcome');
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
        $token = $user->api_token;

        if( ! $user->images->count() && ! $user->albums->count() )
        {
            return view('home_empty')
                ->with( compact('token') );
        }

        $album_slides = new Slideshow( $user->my_albums() );

		return view('home')
            ->with( compact('album_slides', 'token') );
    }

    public function album($album_id)
    {
        if(!Auth::check())
        {
            return redirect()->route('login');
        }

        $album = Album::findOrFail($album_id);
        $user = Auth::user();
        $album_slides = new Slideshow( $user->my_albums() );
        $token = $user->api_token;

        return view('album')
            ->with( compact('album_slides', 'album_id', 'token') );
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
