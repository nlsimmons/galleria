<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Slide
{
    public $item;
    public $previous;
    public $next;

    public function __construct($item)
    {
        if( !is_array($item) && !is_object($item) )
            $item = [ 'id' => $item ];

        $this->item = $item;
    }

    public function __get($name)
    {
        if( $name == 'id' )
            return $this->id();
        if( $name == 'display_url' || $name == 'download_link' )
            return $this->item->$name();

        return $this->item->$name;
    }

    public function id()
    {
        if(is_array($this->item))
            return $this->item['id'];

        return $this->item->id;
    }

    public function images()
    {
        if( !is_array($this->item) )
        {
            return $this->item->slideImages();
        }
    }
}

