<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Waterfall extends Model
{
	public $data;

    public function __construct(Collection $items)
    {
    	$this->data = $items;
    }
}

