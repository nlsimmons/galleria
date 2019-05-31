<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use ImageManager;

use App\Image;
use App\Slideshow;

class PageController extends Controller
{
    public function main()
    {
        $slides = ( new Slideshow( Image::all() ) )->data;

        return view('main')->with( compact('slides') );
    }

    public function index()
    {
    	if(!Auth::check())
    	{
    		return redirect()->route('welcome');
    	}

    	$slides = ( new Slideshow(
            Image::where( ['owner' => Auth::id()] )
                ->get() )
        )->data;

		return view('home')->with( compact('slides') );
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
            $this->storeFile($file);
        }

        return redirect('home');
    }

    protected function storeFile( \Illuminate\Http\UploadedFile $file )
    {
        $name = md5($file);
        $img = ImageManager::make($file);;

        Storage::put(
            $main_img = 'public/images/' . $name . '.jpg',
            $img->encode('jpg')
        );
        Storage::put(
            $display_img = 'public/images/' . $name . '_display.jpg',
            $img->widen(500)->encode('jpg')
        );
        Storage::put(
            $thumb_img = 'public/images/' . $name . '_thumb.jpg',
            $img->widen(100)->encode('jpg')
        );

        $image = new Image;
        $image->url = $main_img;
        $image->display_url = $display_img;
        $image->thumbnail_url = $thumb_img;
        $image->owner = Auth::id();
        $image->save();
    }
}
