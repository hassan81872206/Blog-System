<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Post extends Component
{
    /**
     * Create a new component instance.
     */

     public $title;
     public $date;
     public $description;
     public $id ;

    public function __construct($title , $date , $description , $id)
    {
        $this->title = $title ;
        $this->date = $date ;
        $this->description = $description ;
        $this->id = $id ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post');
    }
}