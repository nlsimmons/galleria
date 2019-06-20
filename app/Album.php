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

    public function slideImages()
    {
        return $this->images->take(3);
    }

    public function display_url()
    {
    	$first_image = $this->images()->first();
        return $first_image ? $first_image->display_url() : asset('/assets/placeholder.png');
        ;
    }
}
