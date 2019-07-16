<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use App\Image;
use App\Album;

use Intervention\Image\ImageManagerStatic as ImageManager;
ImageManager::configure(array('driver' => 'imagick'));

class ImageController extends Controller
{
    public function retrieve($filename, $size=0)
    {
        $id = explode('-', $filename)[0];
        $image = ImageManager::make( Image::findOrFail($id)->file() );

        if($size)
        {
            $image->resize(null, $size, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $response = Response::make($image->encode('jpg'));
        $response->header('Cache-control', 'max-age=3600');
        return $response;
    }

    public function editTitle(Request $request, $id)
    {
    	$image = Image::find($id);
    	// Do some validation

    	$image->title = $request->value;
    	$image->save();
    }

    public function getFile($file)
    {
		return response()->download( storage_path('app/public/images/' . $file . '.jpg') );
	}

    public function action(Request $request, $id)
    {
        $image = Image::find($id);

        switch($request->action)
        {
            case 'delete':
                Image::destroy($id);
                break;
            case 'rotate-left':
                Image::rotate($id, 90);
                break;
            case 'rotate-right':
                Image::rotate($id, -90);
                break;
        }

        if($request->album)
            return redirect()->route('album', ['id' => $request->album ] );
        else
            return redirect()->route('home');
    }

    public function upload(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('welcome');
        }

        $user = Auth::user();

        $file = $request->file('image');

        $image = Image::upload( $file, $user->id );
        $image->owner_id = $user->id;
        $image->save();

        $user->images()->save($image);

        if( !empty($request->_api) )
            return $image;

        return redirect()->route('album', ['id' => $album_id]);
    }
}
