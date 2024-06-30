<?php

namespace App\Http\Livewire\Parent;

use Livewire\Component;

class Faqs extends Component
{
    public function render()
    {
        return view('livewire.parent.faqs')
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je de meest gestelde vragen terugvinden.',
                'title' => 'FAQ',
            ]);
    }
}
