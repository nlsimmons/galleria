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

        $slides = [];
        $next_keys = $items->pluck('id');
        $prev_keys = $items->pluck('id');
        $next_keys = $next_keys->push( $next_keys->shift() )->toArray();
        $prev_keys = $prev_keys->prepend( $prev_keys->pop() )->toArray();

        $i = 0;
        foreach($items->all() as $item)
        {
            $item->next = $next_keys[$i];
            $item->previous = $prev_keys[$i];
            $i++;
        }

        // dd($items);

    	$this->data = $items;
    }
}

