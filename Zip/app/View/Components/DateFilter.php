<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class DateFilter extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $label;
     public $id;
     public $name;
     public $value;

    public function __construct($label,$id, $name,$value)
    {
        // dd(1);

        $this->label=$label;
        $this->name=$name;
        $this->id=$id;
        $this->value=$value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.date-filter');
    }
}
