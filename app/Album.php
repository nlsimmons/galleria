<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	public function owner()
	{
		return $this->belongsTo('App\User');
	}

    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function images()
    {
    	return $this->belongsToMany('App\Image');
    }

    public function first_image()
    {
    	$first_image = $this->getImages()->first();
        return $first_image->url ?? '';
    }

    public function getImages($waterfall=false)
    {
        $images = $this->images->reverse();
        if(!$waterfall)
            return $images;

        return $images->mapToGroups( function($item, $key) {
            return [ $key % 3 => $item ];
        });
    }
}
