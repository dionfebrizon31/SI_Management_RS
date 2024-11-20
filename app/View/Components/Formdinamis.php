<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Formdinamis extends Component
{
    /**
     * Create a new component instance.
     */

    public $tittle;
    public $tipe;
    public $send;
    public $value;


    public function __construct($tittle = 'Null',$tipe = 'Null',$send ='null',$value='')
    {

        $this->tittle = $tittle;
        $this->tipe = $tipe;
        $this->send = $send;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.formdinamis');
    }
}
