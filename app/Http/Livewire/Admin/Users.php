<?php

namespace App\Http\Livewire\Admin;

use App\Actions\Fortify\PasswordValidationRules;
use App\Mail\SetPasswordEmail;
use App\Models\Gender;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAttendance;
use Hash;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithPagination;
use Mail;
use Str;
use URL;

class Users extends Component
{
    use WithPagination;

    public $perPage = 6; //Voorlopig op 2 om een betere weergave vd pagination te krijgen.
    public $loading = 'Even geduld, a.u.b. ...';
    public $search;
    public $roles;
    public $role = '%';
    public $gender = '%';
    public $genders;
    // show/hide the modal
    public $showModal = false;

    public $newUser = [
        'id' => null,
        'role_id' => null,
        'gender_id' => null,
        'first_name' => null,
        'last_name' => null,
        'street' => null,
        'house_number' => null,
        'city' => null,
        'phone_number' => null,
        'postal_code' => null,
        'date_of_birth' => null,
        'email' => null,
        'email_verified_at' => null,
    ];


    // validation rules (use the rules() method, not the $rules property)
    protected function rules()
    {
        return [
            'newUser.role_id' => 'required',
            'newUser.gender_id' => 'required',
            'newUser.first_name' => 'required',
            'newUser.last_name' => 'required',
            'newUser.street' => 'required',
            'newUser.house_number' => 'required',
            'newUser.city' => 'required',
            'newUser.phone_number' => 'required',
            'newUser.postal_code' => 'required',
//            'newUser.national_insurance_number' => 'required',
            'newUser.date_of_birth' => 'required',
            'newUser.email' => ['required', 'string', 'email', 'max:255'],
//            'newUser.password' =>  ['required', 'string', new \Laravel\Fortify\Rules\Password, 'confirmed'],//[Password::min(8), 'required', 'confirmed'],
            //'newUser.confirmation_password' => 'required|same:newUser.password',
        ];
    }

    // validation attributes
    protected $validationAttributes = [
        'newUser.role_id' => 'rol',
        'newUser.gender_id' => 'gender',
        'newUser.first_name' => 'Voornaam',
        'newUser.last_name' => 'Achternaam',
        'newUser.street' => 'Straatnaam',
        'newUser.house_number' => 'Het huisnummer',
        'newUser.city' => 'Stad/Gemeente',
        'newUser.phone_number' => 'Telefoon',
        'newUser.postal_code' => 'De postcode',
//        'newUser.national_insurance_number' => 'Het rijksregisternummer',
        'newUser.date_of_birth' => 'De geboortedatum',
        'newUser.email' => 'Het e-mailadres',
//        'newUser.password' => 'Het wachtwoord',
        //'newUser.confirmation_password' => 'Wachtwoord bevestigen',
    ];

    public function setNewUser(User $user = null)
    {
        $this->resetErrorBag();
        if ($user) {
            $this->newUser['id'] = $user->id;
            $this->newUser['role_id'] = $user->role_id;
            $this->newUser['gender_id'] = $user->gender_id;
            $this->newUser['first_name'] = $user->first_name;
            $this->newUser['last_name'] = $user->last_name;
            $this->newUser['street'] = $user->street;
            $this->newUser['house_number'] = $user->house_number;
            $this->newUser['city'] = $user->city;
            $this->newUser['phone_number'] = $user->phone_number;
            $this->newUser['postal_code'] = $user->postal_code;
            $this->newUser['national_insurance_number'] = $user->national_insurance_number;
            $this->newUser['date_of_birth'] = $user->date_of_birth;
            $this->newUser['email'] = $user->email;
        }
        else{

            $this->reset('newUser');
        }
        $this->showModal = true;
    }


    public function createNewUser()
    {
        $this->validate();
        $password = Str::random(16); // generate a random password
        $user = User::create([
            'role_id' => $this->newUser['role_id'],
            'gender_id' => $this->newUser['gender_id'],
            'first_name' => $this->newUser['first_name'],
            'last_name' => $this->newUser['last_name'],
            'street' => $this->newUser['street'],
            'house_number' => $this->newUser['house_number'],
            'city' => $this->newUser['city'],
            'phone_number' => $this->newUser['phone_number'],
            'postal_code' => $this->newUser['postal_code'],
            'date_of_birth' => $this->newUser['date_of_birth'],
            'email' => $this->newUser['email'],
            'password' => Hash::make($password),
            'email_verified_at' => now(),
        ]);

        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker, <b><i>{$user->first_name} {$user->first_name}</i></b> is toegevoegd",
        ]);

        // Generate a token for the user to set their password
        $token = app('auth.password.broker')->createToken($user);

        // Send an email to the user with a link to set their password
        Mail::to($user->email)->send(new SetPasswordEmail($user, $token));

    }
//    public function updateUserPassword(User $user, Request $request)
//    {
//        $request->validate([
//            'password' => ['required', 'string', new \Laravel\Fortify\Rules\Password],
//        ]);
//
//        $user->password = Hash::make($request->password);
//        $user->save();
//
//        return redirect()->back()->with('success', 'Jouw wachtwoord is aangemaakt.');
//    }


    //Bewerk toegevoegde gebruikers
    public function updateUser(User $user)
    {
        $this->validate();
        $data = [
            'role_id' => $this->newUser['role_id'],
            'gender_id' => $this->newUser['gender_id'],
            'first_name' => $this->newUser['first_name'],
            'last_name' => $this->newUser['last_name'],
            'street' => $this->newUser['street'],
            'house_number' => $this->newUser['house_number'],
            'city' => $this->newUser['city'],
            'phone_number' => $this->newUser['phone_number'],
            'postal_code' => $this->newUser['postal_code'],
            'national_insurance_number' => $this->newUser['national_insurance_number'],
            'date_of_birth' => $this->newUser['date_of_birth'],
            'email' => $this->newUser['email'],
        ];
        if (!empty($this->newUser['password'])) {
            $data['password'] = Hash::make($this->newUser['password']);
        }

        $user->update($data);
        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker <b><i>{$user->first_name} {$user->last_name}</i></b> is bijgewerkt",
        ]);
    }

    public function deleteUser(User $user)
    {
        //$user->member_users()->delete();
        $user->delete();
        $user->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "De gebruiker <b><i>{$user->full_name}</i></b> is verwijderd",
        ]);
    }

    // listen to the delete-user event
    protected $listeners = [
        'delete-user' => 'deleteUser',
    ];

    // reset the paginator
    public function updated($propertyName, $propertyValue)
    {
        if (in_array($propertyName, ['search', 'perPage', 'role']))
        $this->resetPage();
    }


    // get all the roles from the database (runs only once)
    public function mount()
    {
        $this->roles = Role::orderBy('type')->get();
        $this->genders = Gender::orderBy('name')->get();
    }

    public function render()
    {
        //$roles = Role::with('users')->get();
        $query = User::orderBy('last_name')->orderBy('first_name')
            ->searchLastNameOrFirstName($this->search)
            ->where('role_id', 'like', $this->role);
        $users = $query->paginate($this->perPage);
        return view('livewire.admin.users', compact('users'))
            ->layout('layouts.hockeyclub', [
                'description' => 'Beheer de gebruiker',
                'title' => 'Gebruikers',
            ]);
    }
}
