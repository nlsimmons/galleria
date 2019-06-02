<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use ImageManager;

class Image extends Model
{
	private static $display_size = 500;
	private static $thumb_size = 100;

    public static function upload( \Illuminate\Http\UploadedFile $file, $owner_id )
    {
    	$name = md5($file);
        $img = ImageManager::make($file);;

        Storage::put(
            $main_img = 'public/images/' . $name . '.jpg',
            $img->encode('jpg')
        );
        Storage::put(
            $display_img = 'public/images/' . $name . '_display.jpg',
            $img->widen( self::$display_size )->encode('jpg')
        );
        Storage::put(
            $thumb_img = 'public/images/' . $name . '_thumb.jpg',
            $img->widen( self::$thumb_size )->encode('jpg')
        );

        $new = new self;
        $new->url = $main_img;
        $new->display_url = $display_img;
        $new->thumbnail_url = $thumb_img;
        $new->owner = $owner_id;
        $new->save();

        return $new;
    }

    public static function destroy($id)
    {
    	$image = self::find($id);

        if($image)
        {
            Storage::delete([
                $image->url,
                $image->display_url,
                $image->thumbnail_url
            ]);

            return parent::destroy($id);
        }
    }
}
