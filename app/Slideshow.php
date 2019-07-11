<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Wrapper for Collection class
 */
class Slideshow extends Model
{
	public $slides;

    public function get()
    {
        return $this->slides;
    }

    public function __construct(Collection $items, $allow_add=false)
    {
        foreach($items->all() as $item)
        {
            $this->slides[] = new Slide( $item );
        }

        if($allow_add)
        {
            $this->slides[] = new Slide('add');
        }

        $this->slides = collect($this->slides);
        $this->assignOrder();
    }

    protected function assignOrder()
    {
        foreach($this->slides as $i => $v)
        {
            $this->slides[$i]->previous = $this->id_of($i - 1);
            $this->slides[$i]->next = $this->id_of($i + 1);
        }
    }

    protected function id_of($i)
    {
        if( $i < 0 )
            return $this->slides->last()->id();

        if( $i >= $this->slides->count() )
            return $this->slides->first()->id();

        return $this->slides[$i]->id();
    }
}

