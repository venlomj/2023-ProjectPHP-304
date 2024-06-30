<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\Parent\Registrations;
use App\Models\Registration;
use App\Models\Season;
use App\Models\Size;
use Couchbase\SearchOptions;
use Livewire\Component;

class Seasons extends Component
{
    public $selectedRegistration;

    public $newSeason = [
        'id' => null,
        'name' => null,
        'start_date' => null,
        'end_date' => null,
        'active' => null,
        'amount' => null
    ];

    public $openModal=false;


    protected function rules()
    {
        return [
            'newSeason.name' => 'required|unique:seasons,name,' . $this->newSeason['id'],
            'newSeason.amount' => 'required',
            'newSeason.start_date' => 'required',
            'newSeason.end_date' => 'required',
        ];
    }

    protected $validationAttributes = [
        'newSeason.name' => 'name',
        'newSeason.amount' => 'Price',
        'newSeason.start_date' => 'Start date',
        'newSeason.end_date' => 'End date'
    ];

    public function setNewSeason(Season $season = null)
    {
        $this->resetErrorBag();
        if ($season) {
            $this->newSeason['id'] = $season->id;
            $this->newSeason['name'] = $season->name;
            $this->newSeason['start_date'] = $season->start_date;
            $this->newSeason['end_date'] = $season->end_date;
            $this->newSeason['active'] = $season->active;
            $this->newSeason['amount'] = $season->amount;
        } else {
            $this->reset('newSeason');
        }
        $this->openModal = true;
    }

    // update an existing size
    public function updateSeason(Season $season)
    {
        $this->validate();
        $season->update([
            'name' => $this->newSeason['name'],
            'start_date' => $this->newSeason['start_date'],
            'end_date' => $this->newSeason['end_date'],
            'active' => $this->newSeason['active'],
            'amount' => $this->newSeason['amount'],
        ]);
        $this->openModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het seizoen <b><i>{$season->name}</i></b> is bijgewerkt.",
        ]);
    }

//    public function updateSeason(Season $season = null)
//    {
//        $this->validate();
//        $season->update([
//            'name' => $this->newSeason['name'],
//            'start_date' => $this->newSeason['start_date'],
//            'end_date' => $this->newSeason['end_date'],
//            'active' => $this->newSeason['active'],
//            'amount' => $this->newSeason['amount'],
//
//        ]);
//        $this->openModal = false;
//        $this->dispatchBrowserEvent('swal:toast', [
//            'background' => 'success',
//            'html' => "Het seizoen <b><i>{$season->name}</i></b> is bijgewerkt.",
//        ]);
//        $this->openModal = true;
//    }

//    public function setNewSeason()
//    {
////        $this->resetErrorBag();
//        $this->reset('newSeason');
//        $this->openModal = true;
//    }

    public function createSeason()
    {
        $this->validate();
        if($this->newSeason['active'] == null) $this->newSeason['active'] = false;
        Season::create([
            'name' => trim($this->newSeason['name']),
            'start_date' => $this->newSeason['start_date'],
            'end_date' => $this->newSeason['end_date'],
            'active' => $this->newSeason['active'],
            'amount' => $this->newSeason['amount']
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het seizoen <b><i>{$this->newSeason['name']}</i></b> is toegevoegd.",
        ]);
        $this->openModal = false;
    }

    public function deleteSeason(Season $season)
    {
        $season->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het Seizoen <b><i>{$season->name}</i></b> is verwijderd",
        ]);
    }

    public function render()
    {
        $seizoen = Season::orderBy('active', 'desc')
            ->get();
        return view('livewire.admin.season', compact('seizoen'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je het seizoen beheren.',
                'title' => 'Seizoen',
            ]);
    }
}
