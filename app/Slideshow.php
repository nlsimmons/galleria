<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Slideshow extends Model
{
	public $data;

    public function __construct(Collection $items, $allow_add=true)
    {
    	if($allow_add)
    	{
    		$items->push( new class { public $id = 'add'; } );
    	}

    	$items->each(function($item, $key) use ($items) {
    		$item->next = $items->get($key+1)
    			? $items->get($key+1)->id
    			: $items->first()->id;
    		$item->previous = $items->get($key-1)
    			? $items->get($key-1)->id
    			: $items->last()->id;
    	});

    	$this->data = $items;
    }
}
