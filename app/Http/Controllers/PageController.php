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

        foreach($albums as $album)
        {
            if( ! $album->images->count() )
            {
                $album->delete();
                return redirect('home');
            }
        }

        $album_slides = new Slideshow( $albums );

		return view('home')
            ->with( compact('album_slides') );
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

        if( $request->album == 'new' )
        {
            return redirect()->route('album', ['id' => $album_id]);
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

        $slide_columns = $slides->chunk( ceil($slides->count() / 3) );

        return view('welcome')
            ->with( compact('slide_columns', 'options') );
    }
}
