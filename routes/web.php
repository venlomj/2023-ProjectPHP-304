<?php

use App\Http\Livewire\Admin\Fields;
use App\Http\Livewire\Admin\Types;
use App\Http\Livewire\Admin\HourlyWages;
use App\Http\Livewire\Admin\Seasons;
use App\Http\Livewire\Admin\Sizes;
use App\Http\Livewire\Admin\Users;
use App\Http\Livewire\FinancialAdministrator\PaymentMethods;
use App\Http\Livewire\FinancialAdministrator\PaymentRegistration;
use App\Http\Livewire\Parent\Faqs;
use App\Http\Livewire\Parent\Help;
use App\Http\Livewire\Parent\Products;
use App\Http\Livewire\Trainer\Calender;
use App\Http\Livewire\Trainer\DistributionList;
use App\Http\Livewire\Parent\Registrations;
use App\Http\Livewire\Trainer\Expenses;
use App\Http\Livewire\Trainer\GroupReview;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
});
Route::get('calenders', Calender::class)->name('calenders');
Route::get('registrations', Registrations::class)->name('registrations');
Route::get('products', Products::class)->name('products');
Route::get('help', Help::class)->name('help');
Route::get('faq', Faqs::class)->name('faq');


//Admins routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('users', Users::class)->name('users');
    Route::get('sizes', Sizes::class)->name('sizes');
    Route::get('fields', Fields::class)->name('fields');
    Route::get('season', Seasons::class)->name('season');
    Route::get('type', Types::class)->name('types');
    Route::get('hourlywages', HourlyWages::class)->name('hourlywages');

});

//Financial Manager routes
Route::middleware(['auth', 'financieel-beheerder'])->prefix('financieel-beheerder')->name('financieel-beheerder.')->group(function ()
{
    Route::get('payment-registration', PaymentRegistration::class)->name('payment-registration');
    Route::get('payment-methods', PaymentMethods::class)->name('payment-methods');
});

//Trainer's route
Route::middleware(['auth', 'trainer'])->prefix('trainer')->name('trainer.')->group(function () {
    Route::get('distribution-list', DistributionList::class)->name('distribution-list');
    Route::get('calender', Calender::class)->name('calender');
    Route::get('group-review', GroupReview::class)->name('group-review');
    Route::get('expenses', Expenses::class)->name('expenses');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
