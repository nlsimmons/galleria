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

    public function cover_image()
    {
        // dd($this);

    	$first_image = $this->images->last();
        if(! $first_image) return null;

        return $first_image->uri(200) ?? '';
    }
}
