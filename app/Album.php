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

    public function display_url()
    {
    	return $this->images()->first()->display_url;
    }
}
