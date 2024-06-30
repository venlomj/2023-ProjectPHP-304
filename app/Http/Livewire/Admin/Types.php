<?php

namespace App\Http\Livewire\Admin;

use App\Models\Price;
use App\Models\Type;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Types extends Component
{
    use WithFileUploads;

    public $newType=[
        'id'=>null,
        'type'=>null,
        'cover'=>null,
        'active'=>null,
        'price'=>null
    ];
    public $openModal=false;

    // validation rules
    protected $rules = [
        'newType' => 'unique:types,type',
    ];

    public function render()
    {
        $prices = Price::orderBy('id')->get();
        $types = Type::orderBy('id')->get();
        return view('livewire.admin.types', compact('types', 'prices'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je types beheren.',
                'title' => 'Types beheren',

            ]);
    }

    public function openModal(){
        $this->openModal=true;
    }

    // create a new size
    public function createType()
    {
        // validate the new size name
        $this->validate();
        // create the size
//        dd($this->newType['cover']);
        $coverImg = Image::make($this->newType['cover']->getRealPath())->encode('jpg', 70);
        $name = 'products/' .$this->newType['type']. '.jpg';
        Storage::disk('public')->put($name, $coverImg, 'public');

        $fileName = $this->newType['cover']->getClientOriginalName();
        $path = $this->newType['cover']->store("/");
            Type::create([
            'type' => trim($this->newType['type']),
            'active' => $this->newType['active'],
            'cover' => $this->newType['type']. '.jpg',
                'price' => $this->newType['price']
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het type <b><i>{$this->newType['type']}</i></b> is toegevoegd",
        ]);
        $this->openModal=false;
    }

    //delete size
    public function deleteType(Type $type)
    {
        $type->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het type <b><i>{$type->type}</i></b> is verwijderd",
        ]);
    }


    // set/reset $newtype and validation

    public function setNewType(Type $type = null)
    {
        $this->resetErrorBag();
        if ($type) {
            $this->newType['id'] = $type->id;
            $this->newType['type'] = $type->type;
            $this->newType['active'] = $type->active;
            $this->newType['cover'] = $type->cover;
            $this->newType['price'] = $type->type_price;
        } else {
            $this->reset('newType');
        }
        $this->openModal = true;
    }

    // update an existing size
    public function updateType(Type $type)
    {
        $this->validate();
        $type->update([
            'type' => $this->newType['type'],
            'active' => $this->newType['active'],
            'cover' => $this->newType['type']. '.jpg',
            'price' => $this->newType['price']
        ]);

        if($type->cover != $this->newType['cover']){
            $newCover = $this->newType['type'];
            $oldCover = $type->type;

            Storage::disk('public')->delete($oldCover);
            $coverImg = Image::make($this->newType['cover']->getRealPath())->encode('jpg', 70);
            Storage::disk('public')->put($newCover, $coverImg, 'public');
        }
        $this->openModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het type <b><i>{$type->type}</i></b> is bijgewerkt.",
        ]);
    }
}
