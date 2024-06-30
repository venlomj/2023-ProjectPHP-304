<?php

namespace App\Http\Livewire\Admin;

use App\Models\Field;
use Livewire\Component;

class Fields extends Component
{
    public $newField=[
        'id'=>null,
        'name'=>null,
        'street'=>null,
        'house_number'=>null,
        'city'=>null,
        'postal_code'=>null,
        'active'=>null,
    ];
    public $openModal=false;
    public $showactive=false;

    // validation rules
    protected function rules()
    {
        return [
            'newField.name' => 'required|unique:fields,name,' . $this->newField['id'],
            'newField.street' => 'required',
            'newField.house_number' => 'required',
            'newField.city' => 'required',
            'newField.postal_code' => 'required',
        ];
    }


    // validation attributes
    protected $validationAttributes = [
        'newField.name' => 'naam',
        'newField.street' => 'straat',
        'newField.house_number' => 'huisnummer',
        'newField.city' => 'Stad/Dorp',
        'newField.postal_code' => 'postcode',
    ];

    public function render()
    {
        $fields = Field::orderBy('id');
        if($this->showactive)
            $fields->where('active', true);
        $fields = $fields->get();
        return view('livewire.admin.fields', compact('fields'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je velden beheren.',
                'title' => 'Veld beheren',
            ]);
    }

    public function openModal(Field $field){
        $this->openModal=true;
        if ($field) {
            $this->newField['id'] = $field->id;
            $this->newField['name'] = $field->name;
            $this->newField['street'] = $field->street;
            $this->newField['house_number'] = $field->house_number;
            $this->newField['city'] = $field->city;
            $this->newField['postal_code'] = $field->postal_code;
            $this->newField['active'] = $field->active;
        } else {
            $this->reset('newField');
        }
    }

    // create a new field
    public function createField()
    {
        // validate the new field name
        $this->validate();
        if($this->newField['active'] == null) $this->newField['active'] = false;
        // create the field
        Field::create([
            'name' => trim($this->newField['name']),
            'street' => trim($this->newField['street']),
            'house_number' => trim($this->newField['house_number']),
            'city' => trim($this->newField['city']),
            'postal_code' => trim($this->newField['postal_code']),
            'active' => $this->newField['active'],
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het veld <b><i>{$this->newField['name']}</i></b> is toegevoegd",
        ]);
        $this->openModal=false;

    }

    //delete field
    public function deleteField(Field $field)
    {
        $field->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het veld <b><i>{$field->name}</i></b> is verwijderd",
        ]);
    }

    // set/reset $newField and validation
    public function setNewField(Field $field = null)
    {
        $this->resetErrorBag();
        if ($field) {
            $this->newField['id'] = $field->id;
            $this->newField['name'] = $field->name;
            $this->newField['street'] = $field->street;
            $this->newField['house_number'] = $field->house_number;
            $this->newField['city'] = $field->city;
            $this->newField['postal_code'] = $field->postal_code;
            $this->newField['active'] = $field->active;
        } else {
            $this->reset('newField');
        }
        $this->openModal = true;
    }

    // update an existing field
    public function updateField(Field $field)
    {
        $this->validate();
        $field->update([
            'name' => $this->newField['name'],
            'street' => $this->newField['street'],
            'house_number' => $this->newField['house_number'],
            'city' => $this->newField['city'],
            'postal_code' => $this->newField['postal_code'],
            'active' => $this->newField['active'],
        ]);
        $this->openModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het veld <b><i>{$field->name}</i></b> is bijgewerkt.",
        ]);
    }
}
