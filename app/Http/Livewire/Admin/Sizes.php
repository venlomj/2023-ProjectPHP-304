<?php

namespace App\Http\Livewire\Admin;

use App\Models\Size;
use Livewire\Component;

class Sizes extends Component
{
    public $newSize=[
        'id'=>null,
        'size'=>null
    ];
    public $openModal=false;

    // validation rules
    protected $rules = [
        'newSize.size' => 'required|unique:sizes,size',
    ];

    // validation attributes
    protected $validationAttributes = [
        'newSize.size' => 'maat',
    ];

    public function render()
    {
        $sizes = Size::orderBy('id')->get();
        return view('livewire.admin.sizes', compact('sizes'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je maten beheren.',
                'title' => 'Maat beheren',
            ]);
    }

    public function openModal(Size $size){
        $this->openModal=true;
        if ($size) {
            $this->newSize['id'] = $size->id;
            $this->newSize['size'] = $size->size;
        } else {
            $this->reset('newSize');
        }
    }

    // create a new size
    public function createSize()
    {
        // validate the new size name
        $this->validate();
        // create the size
        Size::create([
            'size' => trim($this->newSize['size']),
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De maat <b><i>{$this->newSize['size']}</i></b> is toegevoegd",
        ]);
        $this->openModal=false;
    }

    //delete size
    public function deleteSize(Size $size)
    {
        $size->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De maat <b><i>{$size->size}</i></b> is verwijderd",
        ]);
    }

    // set/reset $newSize and validation
    public function setNewSize(Size $size = null)
    {
        $this->resetErrorBag();
        if ($size) {
            $this->newSize['id'] = $size->id;
            $this->newSize['size'] = $size->size;
        } else {
            $this->reset('newSize');
        }
        $this->openModal = true;
    }

    // update an existing size
    public function updateSize(Size $size)
    {
        $this->validate();
        $size->update([
            'size' => $this->newSize['size'],
        ]);
        $this->openModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De maat <b><i>{$size->size}</i></b> is bijgewerkt.",
        ]);
    }
}
