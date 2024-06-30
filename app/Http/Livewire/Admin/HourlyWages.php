<?php

namespace App\Http\Livewire\Admin;

use App\Models\HourlyWage;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class HourlyWages extends Component
{
    public $users;
    public $newHourlyWage=[
        'id'=>null,
        'user_id'=>null,
        'wage'=>null,
        'wage_from'=>null,
    ];
    public $openModal=false;

    // validation rules
    protected function rules()
    {
        return [
            'newHourlyWage.user_id' => 'required',
            'newHourlyWage.wage' => 'required|integer',
            'newHourlyWage.wage_from' => 'required',
        ];
    }


    // validation attributes
    protected $validationAttributes = [
        'newHourlyWage.user_id' => 'trainer',
        'newHourlyWage.wage' => 'loon',
        'newHourlyWage.wage_from' => 'loon vanaf',
    ];

    public function render()
    {
        $dt = Carbon::now()->format("Y-m-d");

        $hourlywages = HourlyWage::orderBy('id');
        $hourlywages = $hourlywages->with('user')->get();
        return view('livewire.admin.hourly-wages', compact('hourlywages','dt'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je trainerslonen beheren.',
                'title' => 'Trainersloon beheren',
            ]);
    }
    public function mount()
    {
        $this->users = User::orderBy('id')->where('role_id',4)->get();
    }
    public function openModal(HourlyWage $hourlywage){
        $this->openModal=true;
        if ($hourlywage) {
            $this->newHourlyWage['id'] = $hourlywage->id;
            $this->newHourlyWage['user_id'] = $hourlywage->user_id;
            $this->newHourlyWage['wage'] = $hourlywage->wage;
            $this->newHourlyWage['wage_from'] = $hourlywage->wage_from;
        } else {
            $this->reset('newHourlyWage');
        }
    }

    // create a new hourly wage
    public function createHourlyWage()
    {
        // validate the new hourly wage
        $this->validate();

        $today = Carbon::now();
        if($this->newHourlyWage['wage_from'] < $today->format('Y-m-d')){
            $this->addError('Startdatum','De startdatum moet later zijn dan vandaag!');
        }
        else{
            // create the hourly wage
            HourlyWage::create([
                'user_id' => trim($this->newHourlyWage['user_id']),
                'wage' => trim($this->newHourlyWage['wage']),
                'wage_from' => trim($this->newHourlyWage['wage_from']),
            ]);
            $currentTrainer = $this->users->where('id', 'like',$this->newHourlyWage['user_id'])->first();
            $this->dispatchBrowserEvent('swal:toast', [
                'background' => 'success',
                'html' => "Het trainersloon van <b><i>{$currentTrainer['first_name']} {$currentTrainer['last_name']}</i></b> is toegevoegd"
            ]);
            $this->openModal=false;
        }
    }

    //delete field
    public function deleteHourlyWage(HourlyWage $hourlyWage)
    {
        $hourlyWage->delete();
        $currentTrainer = $this->users->where('id', 'like',$this->newHourlyWage['user_id'])->first();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het trainersloon van <b><i>{$currentTrainer['first_name']} {$currentTrainer['last_name']}</i></b> is verwijderd",
        ]);
    }

    // set/reset $newHourlyWage and validation
    public function setNewHourlyWage(HourlyWage $hourlyWage = null)
    {
        $this->resetErrorBag();
        if ($hourlyWage) {
            $this->newHourlyWage['id'] = $hourlyWage->id;
            $this->newHourlyWage['user_id'] = $hourlyWage->user_id;
            $this->newHourlyWage['wage'] = $hourlyWage->wage;
            $this->newHourlyWage['wage_from'] = $hourlyWage->wage_from;
        } else {
            $this->reset('newHourlyWage');
        }
        $this->openModal = true;
    }

    // update an existing hourly wage
    public function updateHourlyWage(HourlyWage $hourlyWage)
    {
        $this->validate();
        $hourlyWage->update([
            'user_id' => $this->newHourlyWage['user_id'],
            'wage' => $this->newHourlyWage['wage'],
            'wage_from' => $this->newHourlyWage['wage_from'],
        ]);
        $this->openModal = false;
        $currentTrainer = $this->users->where('id', 'like',$this->newHourlyWage['user_id'])->first();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het trainersloon <b><i>{$currentTrainer['first_name']} {$currentTrainer['last_name']}</i></b> is bijgewerkt.",
        ]);
    }
}
