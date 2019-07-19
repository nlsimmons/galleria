<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Waterfall extends Model
{
	public $columns;

    public function __construct(Collection $images, $num_cols)
    {
    	$images = $images->reverse();

        $this->columns = $images->mapToGroups( function($item, $key) use ($num_cols) {
            return [ $key % $num_cols => $item ];
        });
    }
}

