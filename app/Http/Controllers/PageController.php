<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Image;
use App\Slideshow;

class PageController extends Controller
{
    public function index()
    {
    	if(!Auth::check())
    	{
    		return redirect()->route('welcome');
    	}

    	$slides = ( new Slideshow( Image::all() ) )->data;

		return view('home')->with( compact('slides') );
    }

    public function upload(Request $request)
    {
    	if(!Auth::check())
    	{
    		return redirect()->route('welcome');
    	}

        dd($request);

    	return view('upload');
    }
}
