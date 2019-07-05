<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\UploadedFile;
use ImageManager;

class Image extends Model
{
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

    public function display_url()
    {
        return $this->display_url;
    }

    public static function upload($file, $owner_id, $album=null)
    {
    	$image_name = md5($file);
        $img = ImageManager::make($file)->orientate();

        $new = new self;
        $new->owner = $owner_id;

        Storage::put(
            $url = 'public/images/' . $image_name . '.jpg',
            $img->encode('jpg')
        );
        $new->url = $url;

        return $new;
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
