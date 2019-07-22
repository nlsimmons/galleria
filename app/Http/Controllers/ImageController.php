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
    public function home(Request $request)
    {
        $size = $request->size;

        $user = Auth::user();

        $home_images = $user->images->sortByDesc('created_at')->take(50);
        $home_images = $home_images->each(function($img) use ($size) {
            $img->image_url = $img->uri($size);
        });

        return $home_images->values();
    }

    public function welcome(Request $request)
    {
        $size = $request->size;

        $welcome_images = Image::all();
        if( $welcome_images->count() )
        {
            $welcome_images = $welcome_images
                ->random( min(50, $welcome_images->count()) )->shuffle();
            $welcome_images->each(function($img) use ($size) {
                $img->image_url = $img->uri($size);
            });
        }

        return $welcome_images->values();
    }

    public function retrieve($string, $size=0)
    {
        $hash = substr($string, 0, -2);
        $image = Image::where('hash', '=', $hash)->firstOrFail();
        $in_image = ImageManager::make( $image->file() );

        if($size)
        {
            $in_image->resize(null, $size, function($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        $response = Response::make($in_image->encode('jpg'));
        $response->header('ETag', $image->check());
        $response->header('Cache-Control', 'public, max-age=31536000');
        $response->header('Content-Type', 'image/jpg');
        return $response;
    }

    public function retrievePreview($ref)
    {
        $file = storage_path('app/tmp/images/') . $ref;

        $image = ImageManager::make($file);

        $image->resize(null, 120, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $response = Response::make($image->encode('jpg'));
        $response->header('Content-Type', 'image/jpg');
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

    public function delete(Request $request, $id)
    {
        try {
            Image::destroy($id);
        } catch( \Exception $e ) {
            throw $e;
        }

        return 'success';
    }

    public function action(Request $request, $id)
    {
        $image = Image::find($id);

        if( Auth::id() !== $image->owner->id )
        {
            throw new Exception('You are not authorized to access this resource.');
        }

        switch($request->action)
        {
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

    public function preupload(Request $request)
    {
        $file = $request->file('image');
        $image_ref = Image::uploadPreview($file);
        return ['src' => $image_ref];
        // return $this->retrievePreview($image_ref);
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
