<?php

namespace App\Http\Livewire\FinancialAdministrator;

use App\Models\User;
use Livewire\Component;

class PaymentRegistration extends Component
{
    public function render()
    {

        $paymentRegistrations = User::with('expenses')->with('hourly_wages')->where('role_id', 4)->get();
        dump($paymentRegistrations->toArray());
        return view('livewire.financial-administrator.payment-registration', compact('paymentRegistrations'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Hier kan ik de betalingen registreren',
                'title' => 'Betaling registreren',
            ]);
    }
}
