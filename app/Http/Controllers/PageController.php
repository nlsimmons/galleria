<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Image;
use App\Slideshow;
use App\Waterfall;

class PageController extends Controller
{
    public function main()
    {
        $slides = ( new Slideshow( Image::all() ) )->data;

        return view('main')->with( compact('slides') );
    }

    public function home()
    {
    	if(!Auth::check())
    	{
    		return redirect()->route('welcome');
    	}

        $slides = ( new Slideshow(
            Image::where( ['owner' => Auth::id()] )
                ->latest()
                ->get()
        ) )->data;
        $options = ['allow_delete' => true];

		return view('home')->with( compact('slides', 'options') );
    }

    public function upload(Request $request)
    {
    	if(!Auth::check())
    	{
    		return redirect()->route('welcome');
    	}

        $files = $request->file('image-no-album');
        foreach( $files as $file )
        {
            Image::upload( $file, Auth::id() )->save();
        }

        return redirect('home');
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

        // dd($slides);

        $slide_columns = $slides->chunk( $slides->count() / 3 );
        // dd($slide_columns);

        return view('welcome')
            ->with( compact('slide_columns', 'options') );
    }
}
