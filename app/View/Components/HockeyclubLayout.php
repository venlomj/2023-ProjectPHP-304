<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HockeyclubLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

    public $avatar;

    protected $listeners = ['refresh-navigation-menu' => '$refresh'];
    public function render()
    {
        return view('layouts.hockeyclub');
    }
}
