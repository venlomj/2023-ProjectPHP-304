<?php

namespace App\Http\Livewire\Parent;

use App\Models\Product;
use App\Models\Season;
use App\Models\Size;
use App\Models\Type;
use App\Models\Order;
use App\Models\Orderline;
use Livewire\Component;

class Products extends Component
{

    public $openModal=false;

    public $newProduct=[
        'id'=>null,
        'size_id'=>null,
        'type_id'=>null,
        'quantity'=>null
    ];

    // validation rules
    protected function rules()
    {
        return [
            'newProduct.id' => 'required',
            'newProduct.size_id' => 'required',
            'newProduct.type_id' => 'required',
        ];
    }


    // validation attributes
    protected $validationAttributes = [
        'newProduct.id' => 'id',
        'newProduct.size_id' => 'maat',
        'newProduct.type_id' => 'type',
    ];

    public function render()
    {
        $types = Type::orderBy('id')->get();
        $sizes = Size::orderBy('id')->get();
        $orders = Order::orderBy('id')->get();
        $orderlines = Orderline::orderBy('id')->get();
        $products = Product::orderBy('id')->get();
        return view('livewire.parent.products', compact('types', 'sizes', 'products','orders', 'orderlines'))
        ->layout('layouts.hockeyclub', [
        'description' => 'Hier kan je kleren kopen.',
        'title' => 'Kledij Kopen',
    ]);
    }

    public function selectClothes()
    {
        $this->openModal = true;
    }
}
