<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as ImageManager;

ImageManager::configure(array('driver' => 'imagick'));

class Image extends Model
{
    public function check($length=0)
    {
        $c = md5($this->updated_at);

        $l = !$length ? strlen($c) : $length;
        return substr($c, 0, $l);
    }

    public function uri($size=0)
    {
        $slug = \Str::slug( $this->title ?: $this->hash );
        $s = $size != 0 ? '/' . $size : '';
        return '/public/images/' . $this->id . '-' . $slug . $this->check(2) . $s;
    }

    public function file()
    {
        return storage_path('app/public/images/') . $this->hash;
    }

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function download_link()
    {
        return '/download/image/' . pathinfo($this->url, PATHINFO_FILENAME);
    }

    public function album_link()
    {
        $album = $this->albums->first();
        return '/album/' . $album->id;
    }

    public static function upload($file, $owner_id, $album=null)
    {
        $img = ImageManager::make($file)->orientate();
        $hash = md5($file);

        $new = new self;
        $new->owner_id = $owner_id;

        Storage::put(
            'public/images/' . $hash,
            $img->encode('jpg')
        );
        $new->hash = $hash;

        if(!empty($album))
        {
            Album::find($album)->images()->save($new);
        }

        return $new;
    }

    public static function rotate($id, $dir)
    {
        $image = self::find($id);
        $img = ImageManager::make($image->file())->rotate($dir);

        Storage::put(
            'public/images/' . $image->hash,
            $img->encode('jpg')
        );

        $image->touch();
    }

    public static function destroy($id)
    {
    	$image = self::find($id);

        if($image)
        {
            parent::destroy($id);

            Storage::delete($image->url);
        }
    }
}
