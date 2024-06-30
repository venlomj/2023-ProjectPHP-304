<?php

namespace App\Http\Livewire\Parent;

use App\Http\Livewire\Admin\Seasons;
use App\Models\Gender;
use App\Models\Member;
use App\Models\PaymentMethod;
use App\Models\Registration;
use App\Models\Season;
use Carbon\Carbon;
use Livewire\Component;

class Registrations extends Component
{
    public $newRegistration=[
        'id'=>null,
        'member_id'=>null,
        'payment_method_id'=>null,
        'season_id'=>null,
        'price_id'=>null,
        'registration_date'=>null,
        'payment_date'=>null,
        'payed'=>null,
        'comment'=>null,
    ];
    public $newMember=[
        'id'=>null,
        'first_name'=>null,
        'last_name'=>null,
        'gender_id'=>null,
        'phone_number'=>null,
        'street'=>null,
        'house_number'=>null,
        'city'=>null,
        'postal_code'=>null,
        'national_insurance_number'=>null,
        'date_of_birth'=>null,
        'email'=>null,
        'comment'=>null,
        'active'=>null,
    ];
    public $newUser=[
        'id'=>null,
        'role_id'=>null,
        'gender_id'=>null,
        'first_name'=>null,
        'last_name'=>null,
        'phone_number'=>null,
        'street'=>null,
        'house_number'=>null,
        'city'=>null,
        'postal_code'=>null,
        'national_insurance_number'=>null,
        'date_of_birth'=>null,
        'account_number'=>null,
        'email'=>null,
        'email_verified_at'=>null,
        'password'=>null,
        'current_team_id'=>null,
        'profile_photo_path'=>null,
    ];
    public $openModal=false;
    public $showactive=false;

    // validation rules
    protected function rules()
    {
        return [
            'newMember.first_name' => 'required',
            'newMember.last_name' => 'required',
            'newMember.gender_id' => 'required',
            'newMember.phone_number',
            'newMember.street' => 'required',
            'newMember.house_number' => 'required',
            'newMember.city' => 'required',
            'newMember.postal_code' => 'required',
            'newMember.national_insurance_number',
            'newMember.date_of_birth' => 'required',
            'newMember.email' => 'required|unique|email',
            'newMember.comment',
            'newMember.active' => 'required',
            'newRegistration.member_id' => 'required',
            'newRegistration.payment_method_id' => 'required',
            'newRegistration.season_id' => 'required',
            'newRegistration.price_id' => 'required',
            'newRegistration.registration_date' => 'required',
            'newRegistration.payment_date',
            'newRegistration.payed' => 'required',
            'newRegistration.comment',
            'newUser.role_id' => 'required',
            'newUser.gender_id' => 'required',
            'newUser.first_name' => 'required',
            'newUser.last_name' => 'required',
            'newUser.phone_number' => 'required',
            'newUser.street' => 'required',
            'newUser.house_number' => 'required',
            'newUser.city',
            'newUser.postal_code' => 'required',
            'newUser.national_insurance_number',
            'newUser.date_of_birth' => 'required',
            'newUser.account_number',
            'newUser.email' => 'required|unique|email',
            'newUser.email_verified_at',
            'newUser.password',
            'newUser.current_team_id',
            'newUser.profile_photo_path',
        ];
    }


    // validation attributes
    protected $validationAttributes = [
        'newMember.first_name' => 'voornaam',
        'newMember.last_name' => 'achternaam',
        'newMember.gender_id' => 'geslacht',
        'newMember.phone_number' => 'telefoonnummer',
        'newMember.street' => 'straat',
        'newMember.house_number' => 'huisnummer',
        'newMember.city' => 'dorp/stad',
        'newMember.postal_code' => 'postcode',
        'newMember.national_insurance_number' => 'rijksregisternummer',
        'newMember.date_of_birth' => 'geboortedatum',
        'newMember.email' => 'email',
        'newMember.comment' => 'opmerking',
        'newMember.active' => 'actief',
        'newRegistration.member_id' => 'lid',
        'newRegistration.payment_method_id' => 'betaalmethode',
        'newRegistration.season_id' => 'seizoen',
        'newRegistration.price_id' => 'prijs',
        'newRegistration.registration_date' => 'inschrijvings dag',
        'newRegistration.payment_date' => 'betaaldag',
        'newRegistration.payed' => 'betaald',
        'newRegistration.comment' => 'opmerking',
        'newUser.role_id' => 'rol',
        'newUser.gender_id' => 'geslacht',
        'newUser.first_name' => 'voornaam',
        'newUser.last_name' => 'achternaam',
        'newUser.phone_number' => 'telefoonnummer',
        'newUser.street' => 'straat',
        'newUser.house_number' => 'huisnummer',
        'newUser.city' => 'stad/dorp',
        'newUser.postal_code' => 'postcode',
        'newUser.date_of_birth' => 'geboortedatum',
        'newUser.account_number' => 'accountnummer',
        'newUser.email' => 'email',
    ];

    public function render()
    {
        $registrations = Registration::orderBy('id');
        $payment_methods = PaymentMethod::orderBy('id')->get();
        $genders = Gender::orderBy('id')->get();
        $season = Season::orderBy('id')->where([
            ['start_date','<=',Carbon::now()],
            ['end_date','>=',Carbon::now()],
        ])->first();

        if($this->showactive)
            $registrations->where('active', true);
        $registrations = $registrations->get();
        return view('livewire.parent.registrations', compact('registrations','season','payment_methods','genders'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Vul hier de gegevens van je zoon of dochter in om ze in te schrijven in onze club.',
                'title' => 'Inschrijven',
            ]);
    }

    public function openModal(Registration $registration, Member $member){
        $this->openModal=true;
        if ($registration) {
            $this->newRegistration['id'] = $registration->id;
            $this->newRegistration['member_id'] = $registration->member_id;
            $this->newRegistration['payment_method_id'] = $registration->payment_method_id;
            $this->newRegistration['season_id'] = $registration->season_id;
            $this->newRegistration['price_id'] = $registration->price_id;
            $this->newRegistration['registration_date'] = $registration->registration_date;
            $this->newRegistration['payment_date'] = $registration->payment_date;
            $this->newRegistration['payed'] = $registration->payed;
            $this->newRegistration['comment'] = $registration->comment;
            $this->newMember['first_name'] = $member->first_name;
            $this->newMember['last_name'] = $member->last_name;
            $this->newMember['gender_id'] = $member->gender_id;
            $this->newMember['phone_number'] = $member->phone_number;
            $this->newMember['street'] = $member->street;
            $this->newMember['house_number'] = $member->house_number;
            $this->newMember['city'] = $member->city;
            $this->newMember['postal_code'] = $member->postal_code;
            $this->newMember['national_insurance_number'] = $member->national_insurance_number;
            $this->newMember['date_of_birth'] = $member->date_of_birth;
            $this->newMember['email'] = $member->email;
            $this->newMember['comment'] = $member->comment;
            $this->newMember['active'] = $member->active;
        } else {
            $this->reset('newRegistration');
        }
    }

    // create a new registration
    public function createRegistration()
    {
        // validate the new registration
        $this->validate();
        if($this->newRegistration['active'] == null) $this->newRegistration['active'] = false;
        // create the registration
        Registration::create([
            'role_id' => trim($this->newUser['role_id']),
            'gender_id' => trim($this->newUser['gender_id']),
            'first_name' => trim($this->newUser['first_name']),
            'last_name' => trim($this->newUser['last_name']),
            'phone_number' => trim($this->newUser['phone_number']),
            'street' => trim($this->newUser['street']),
            'house_number' => trim($this->newUser['house_number']),
            'city' => trim($this->newUser['city']),
            'postal_code' => trim($this->newUser['postal_code']),
            'national_insurance_number' => trim($this->newUser['national_insurance_number']),
            'date_of_birth' => trim($this->newUser['date_of_birth']),
            'account_number' => trim($this->newUser['account_number']),
            'email' => trim($this->newUser['email']),
            'email_verified_at' => trim($this->newUser['email_verified_at']),
            'password' => trim($this->newUser['password']),
            'current_team_id' => trim($this->newUser['current_team_id']),
            'profile_photo_path' => trim($this->newUser['profile_photo_path']),
        ]);
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Je kind, <b><i>{$this->newRegistration['first_name']}</i></b> is ingeschreven in onze club.",
        ]);
        $this->openModal=false;

    }

    //delete registration
    public function deleteRegistration(Registration $registration)
    {
        $registration->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het veld <b><i>{$registration->name}</i></b> is verwijderd",
        ]);
    }

    // set/reset $newRegistration and validation
    public function setNewRegistration(Registration $registration = null, Member $member = null)
    {
        $this->resetErrorBag();
        if ($registration) {
            $this->newRegistration['id'] = $registration->id;
            $this->newRegistration['member_id'] = $registration->member_id;
            $this->newRegistration['payment_method_id'] = $registration->payment_method_id;
            $this->newRegistration['season_id'] = $registration->season_id;
            $this->newRegistration['price_id'] = $registration->price_id;
            $this->newRegistration['registration_date'] = $registration->registration_date;
            $this->newRegistration['payment_date'] = $registration->payment_date;
            $this->newRegistration['payed'] = $registration->payed;
            $this->newRegistration['comment'] = $registration->comment;
            $this->newMember['first_name'] = $member->first_name;
            $this->newMember['last_name'] = $member->last_name;
            $this->newMember['gender_id'] = $member->gender_id;
            $this->newMember['phone_number'] = $member->phone_number;
            $this->newMember['street'] = $member->street;
            $this->newMember['house_number'] = $member->house_number;
            $this->newMember['city'] = $member->city;
            $this->newMember['postal_code'] = $member->postal_code;
            $this->newMember['national_insurance_number'] = $member->national_insurance_number;
            $this->newMember['date_of_birth'] = $member->date_of_birth;
            $this->newMember['email'] = $member->email;
            $this->newMember['comment'] = $member->comment;
            $this->newMember['active'] = $member->active;
        } else {
            $this->reset('newRegistration');
        }
        $this->openModal = true;
    }

    // update an existing registration
    public function updateRegistration(Registration $registration)
    {
        $this->validate();
        $registration->update([
            'name' => $this->newRegistration['name'],
            'street' => $this->newRegistration['street'],
            'house_number' => $this->newRegistration['house_number'],
            'city' => $this->newRegistration['city'],
            'postal_code' => $this->newRegistration['postal_code'],
            'active' => $this->newRegistration['active'],
        ]);
        $this->openModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Het veld <b><i>{$registration->name}</i></b> is bijgewerkt.",
        ]);
    }
}
