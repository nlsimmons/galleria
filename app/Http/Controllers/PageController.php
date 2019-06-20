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
    public function default()
    {
        return redirect()->route('welcome');
    }

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

        $images = Auth::user()->my_images;
        $albums = Auth::user()->my_albums;

        if(count($images) == 0)
        {
            return view('empty_gallery');
        }

        // $images = (new Slideshow( $images ));
        $album_slides = (new Slideshow( $albums ));

		return view('home')->with( compact('images', 'album_slides') );
    }

    public function upload(Request $request)
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

            $user->my_albums()->save($album);
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

        $slide_columns = $slides->chunk( ceil($slides->count() / 3) );
        // dd($slide_columns);

        return view('welcome')
            ->with( compact('slide_columns', 'options') );
    }
}
