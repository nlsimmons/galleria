<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

use App\Image;
use App\Album;

use Intervention\Image\ImageManagerStatic as ImageManager;
ImageManager::configure(array('driver' => 'imagick'));

class ImageController extends Controller
{
    public function __construct(Request $request)
    {
        if( $user = Auth::guard('api')->user() )
            Auth::login($user);
    }

    public function home(Request $request)
    {
        $size = $request->size;

        $user = Auth::user();

        $home_images = $user->images->sortByDesc('created_at')->take(50);
        $home_images = $home_images->each(function($img) use ($size) {
            $img->image_url = $img->uri($size);
            $img->album_id = $img->albums->count() ? $img->albums->first()->id : null;
        });

        return $home_images->values();
    }

    public function album(Request $request, $album_id)
    {
        $size = $request->size;

        $album = Album::find($album_id);

        $album_images = $album->images->sortByDesc('created_at');
        $album_images = $album_images->each(function($img) use ($size) {
            $img->image_url = $img->uri($size);
        });

        return $album_images->values();
    }

    public function welcome(Request $request)
    {
        $size = $request->size;

        $welcome_images = Image::all();
        if( $welcome_images->count() )
        {
            $welcome_images = $welcome_images
                ->random( min(30, $welcome_images->count()) )->shuffle();
            $welcome_images->each( function($img) use ($size) {
                $img->image_url = $img->uri($size);
                $img->album_id = $img->albums->count() ? $img->albums->first()->id : null;
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
            $in_image->resize($size, null, function($constraint) {
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
        Image::where('id', $id)
            ->update(['title' => $request->new_title]);
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

    public function upload(Request $request)
    {
        $file = $request->file('image');

        $image_ref = Image::uploadPreview($file);
        return ['src' => $image_ref];
    }

    public function uploadDirect(Request $request)
    {
        $file = $request->file('image');

        if($request->album && $request->album !== 'null')
            $album = $request->album;
        else
            $album = null;

        $new = Image::upload($file, Auth::id(), $album);
        $new->save();
        return $new;
    }

    public function confirm(Request $request, $ref)
    {
        Storage::move( 'tmp/images/' . $ref, 'public/images/' . $ref );

        $new = new Image;
        $new->hash = $ref;
        $new->owner_id = Auth::id();

        if($request->album && $request->album !== 'null')
        {
            Album::find($request->album)->images()->save($new);
        }

        $new->save();

        return $new;
    }
}
