<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    public function images()
    {
        return $this->hasMany('App\Image', 'owner_id');
    }

    public function albums()
    {
        return $this->hasMany('App\Album', 'owner_id');
    }

    public function all_albums()
    {
        return $this->belongsToMany('App\Album');
    }

    public function loose_images()
    {
        return $this->images()->doesntHave('albums')->get();
    }

    public function my_albums()
    {
        return $this->albums->concat(['id' => 'new']);

        $loose = collect( $this->loose_images() );
        $loose->id = 'loose';
        $loose->title = 'Loose Images';

        $albums = $this->albums->concat( [$loose] );
        return $albums;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
