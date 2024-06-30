<?php

namespace App\Http\Livewire\FinancialAdministrator;

use App\Models\PaymentMethod;
use App\Models\Size;
use Livewire\Component;

class PaymentMethods extends Component
{

    public $newPaymentMethod=[
        'id'=>null,
        'method'=>null,
        'active'=>null
    ];
    public $openModal=false;

    // validation rules
    protected $rules = [
        'newPaymentMethod.method' => 'required|unique:payment_methods,method'
    ];

    // validation attributes
    protected $validationAttributes = [
        'newPaymentMethod.method' => 'methode'
    ];

    public function render()
    {
        $methods = PaymentMethod::orderBy('id')->get();
        return view('livewire.financial-administrator.payment-methods', compact('methods'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan je betaalmethodes beheren.',
                'title' => 'Betaalmethode beheren'
            ]);
    }

    public function openModal(PaymentMethod $paymentMethod){
        $this->openModal=true;
        if ($paymentMethod) {
            $this->newPaymentMethod['id'] = $paymentMethod->id;
            $this->newPaymentMethod['method'] = $paymentMethod->method;
            $this->newPaymentMethod['active'] = $paymentMethod->active;
        } else {
            $this->reset('newPaymentMethod');
        }
    }

    public function createPaymentMethod()
    {
        // validate the new method name
        $this->validate();
        // create the method
        PaymentMethod::create([
            'method' => trim($this->newPaymentMethod['method']),
            'active' => $this->newPaymentMethod['active'] ?? false
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De methode <b><i>{$this->newPaymentMethod['method']}</i></b> is toegevoegd",
        ]);
        $this->openModal=false;
    }

    public function deletePaymentMethod(PaymentMethod $paymentMethod)
    {
        $paymentMethod->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De methode <b><i>{$paymentMethod->method}</i></b> is verwijderd",
        ]);
    }

    // set/reset $newPaymentMethod and validation
    public function setNewPaymentMethod(PaymentMethod $paymentMethod = null)
    {
        $this->resetErrorBag();
        if ($paymentMethod) {
            $this->newPaymentMethod['id'] = $paymentMethod->id;
            $this->newPaymentMethod['method'] = $paymentMethod->method;
            $this->newPaymentMethod['active'] = $paymentMethod->active;
        } else {
            $this->reset('newPaymentMethod');
        }
        $this->openModal = true;
    }

    // update an existing method
    public function updatePaymentMethod(PaymentMethod $paymentMethod)
    {
        $this->validate();
        $paymentMethod->update([
            'method' => $this->newPaymentMethod['method'],
            'active' => $this->newPaymentMethod['active'],
        ]);
        $this->openModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De methode <b><i>{$paymentMethod->method}</i></b> is bijgewerkt.",
        ]);
    }
}
