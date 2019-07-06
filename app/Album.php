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
        if( ! $this->images->count() )
        {
            return collect([ 'url' => 'https://via.placeholder.com/500' ]);
        }

        return $this->images->take(4);
    }

    public function display_url()
    {
    	$first_image = $this->images()->first();
        return $first_image ? $first_image->display_url() : asset('/assets/placeholder.png');
        ;
    }
}
