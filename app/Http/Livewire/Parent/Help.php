<?php

namespace App\Http\Livewire\Parent;

use Livewire\Component;

class Help extends Component
{
    public function render()
    {
        return view('livewire.parent.help')
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je meer info vinden over hoe de applicatie werkt.',
                'title' => 'Helpdesk'
            ]);
    }
}
