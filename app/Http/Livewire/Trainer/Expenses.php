<?php

namespace App\Http\Livewire\Trainer;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Expenses extends Component
{
    use WithPagination;

    // filter and pagination
    public $name;
    //preloader
    public $loading = 'Even geduld, a.u.b. ...';
    public $notApproved = false;
    public $perPage = 5;
    // show/hide the modal
    public $showModal = false;
    public $user;
    public $userId;

    public $newExpense = [
        'id' => null,
        'user_id' => null,
        'name' => null,
        'price' => null,
        'comment' => null,
        'approved' => null,
        'rejection' => null,
        'input_date' => null,
        'picture' => null,
        'payment_date' => null,
    ];


    // reset the paginator
    public function updated($propertyName, $propertyValue)
    {
        // reset if the $search, $noCover, $noStock or $perPage property has changed (updated)
        if (in_array($propertyName, ['name', 'notApproved', 'perPage']))
            $this->resetPage();
    }

    public function setNewExpense(Expense $expense = null)
    {
        $this->resetErrorBag();
        if ($expense) {
            $this->newExpense['id'] = $expense->id;
            $this->newExpense['user_id'] = $expense->user_id;
            $this->newExpense['name'] = $expense->name;
            $this->newExpense['price'] = $expense->price;
            $this->newExpense['comment'] = $expense->comment;
            $this->newExpense['approved'] = $expense->approved;
            $this->newExpense['rejection'] = $expense->rejection;
            $this->newExpense['input_date'] = $expense->input_date;
            $this->newExpense['payment_date'] = $expense->payment_date;
        } else {
            $this->reset('newExpense');
            //$this->newExpense['input_date'] = now()->toDateString(); // Set input_date to today's date
        }
        $this->showModal = true;
    }

    // validation rules (use the rules() method, not the $rules property)
    protected function rules()
    {
        $expenseId = $this->newExpense['id'] ?? null;

        return [
            'newExpense.name' => [
                'required',
                Rule::unique('expenses', 'name')->ignore($expenseId),
            ],
            'newExpense.price' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'newExpense.comment' => ['required', 'string'],
            'newExpense.rejection' => 'nullable',
            'newExpense.payment_date' => 'nullable|date',
        ];
    }

    protected $validationAttributes = [
        'newExpense.name' => 'soort van onkost',
        'newExpense.price' => 'de prijs',
        'newExpense.comment' => 'de omschrijving',
    ];

    public function addExpense()
    {
        $this->validate();
        $expense = Expense::create([
            'user_id' => auth()->user()->id,
            'name' => $this->newExpense['name'],
            'price' => $this->newExpense['price'],
            'comment' => $this->newExpense['comment'],
            'approved' => $this->newExpense['approved'] ?? false,
            'rejection' => $this->newExpense['rejection'],
            'input_date' => now()->toDateString(),
            'payment_date' => $this->newExpense['payment_date'],
        ]);

        $this->showModal = false;
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Onkost, <b><i>{$expense->name}</i></b> is ingebracht.",
        ]);
    }

    public function updateExpense(Expense $expense)
    {
        $this->validate();
//        // Retrieve the user by ID
//        $user = User::find('id');
//
//        if ($user) {
//            // User found, set the $this->user object
//            $this->user = $user;
            $expense->update([
                'user_id' => $this->newExpense['user_id'],
                'name' => $this->newExpense['name'],
                'price' => $this->newExpense['price'],
                'comment' => $this->newExpense['comment'],
                'approved' => $this->newExpense['approved'] ?? false,
                'rejection' => $this->newExpense['rejection'],
                'input_date' => now()->toDateString(),
                'payment_date' => $this->newExpense['payment_date'],
            ]);
            $this->showModal = false;
            $this->dispatchBrowserEvent('swal:toast', [
                'background' => 'success',
                'html' => "Onkost, <b><i>{$expense->name}</i></b> is bijgewerkt.",
            ]);
//        }
     }

    public function deleteExpense(Expense $expense)
    {
        //$user->member_users()->delete();
        $expense->delete();
        $this->dispatchBrowserEvent('swal:toast', [
            'background' => 'success',
            'html' => "Onkost, <b><i>{$expense->name}</i></b> is verwijderd",
        ]);
    }

    // listen to the delete-user event
    protected $listeners = [
        'delete-expense' => 'deleteExpense',
    ];


    public function mount()
        {
            $user = User::find('id');
        }
        function render()
        {
            $query = Expense::orderBy('name')
                ->where('name', 'like', "%{$this->name}%");

            // only if $approved is true, filter the query further, else, skip this step
            if ($this->notApproved)
                $query->where('approved', false);
            $expenses = $query->paginate($this->perPage);
            return view('livewire.trainer.expenses', compact('expenses'))
                ->layout('layouts.hockeyclub', [
                    'description' => 'Beheer onkosten',
                    'title' => 'Onkosten',
                ]);
        }
}
