<?php

namespace App\Http\Livewire\Layout;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavBar extends Component
{
    /*public $user;
    public $role;

    public function mount()
    {
        $this->user = Auth::user();
        $this->role = $this->user->role;
    }*/
    protected $listeners = ['refresh-navigation-menu' => '$refresh'];

    public function render()
    {
        return view('livewire.layout.nav-bar');
    }
}
