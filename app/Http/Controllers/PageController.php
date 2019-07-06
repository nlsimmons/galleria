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
    		return redirect()->route('welcome');
    	}

        $albums = Auth::user()->my_albums;

        if( ! $albums->count() )
        {
            return view('home_empty');
        }

        $album_slides = new Slideshow( $albums );

		return view('home')
            ->with( compact('album_slides') );
    }

    public function action(Request $request)
    {
        if( $request->has('delete') )
        {
            Image::destroy($request->delete);
        }

        return $this->home();
    }

    public function welcome()
    {
        $slides = ( new Waterfall(
            Image::where( ['hidden' => '0'] )
                ->latest()
                ->get()
        , false) )->data;
        $options = [];

        $slide_columns = $slides->chunk( ceil($slides->count() / 3) );

        return view('welcome')
            ->with( compact('slide_columns', 'options') );
    }
}
