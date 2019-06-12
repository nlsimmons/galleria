<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\UploadedFile;
use ImageManager;

class Image extends Model
{
    private static $sizes = [
        'display' => 1000,
        'mid' => 500,
        'thumb' => 100,
    ];
	private static $display_size = 800;
	private static $thumb_size = 100;

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

    public static function upload($file, $owner_id)
    {
    	$image_name = md5($file);
        $img = ImageManager::make($file);

        $new = new self;
        $new->owner = $owner_id;

        Storage::put(
            $main_img = 'public/images/' . $image_name . '.jpg',
            $img->encode('jpg')
        );
        $new->url = $main_img;

        foreach( self::$sizes as $size => $width )
        {
            Storage::put(
                $display_img = 'public/images/' . $image_name . '_' . $size .'.jpg',
                $img->widen($width)->encode('jpg')
            );
            $new->{$size.'_url'} = $display_img;
        }

        return $new;
    }

    public static function destroy($id)
    {
    	$image = self::find($id);

        if($image)
        {
            parent::destroy($id);

            Storage::delete([
                $image->url,
                $image->display_url,
                $image->thumbnail_url
            ]);
        }
    }
}
