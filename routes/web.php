<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterUserController;
use App\Http\Livewire\Users\UserRegister;
use App\Http\Livewire\Transactions\Application\CreateApplication;
use App\Http\Livewire\Transactions\Application\CreditInvestigationApplication;
use App\Http\Livewire\Transactions\Application\ApprovalApplication;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->intended(route('dashboard'));
});

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');


Route::get('/test', [DashboardController::class, 'test']);
Route::get('/posttest', [DashboardController::class, 'posttest']);

//user registration
Route::get('/register', UserRegister::class)->name('user.register');
//user registration

//transactions
Route::get('/tranactions/application/create', CreateApplication::class)->name('application.create');
Route::get('/tranactions/application/credit/investigation', CreditInvestigationApplication::class)->name('application.credit.investigation');
Route::get('/tranactions/application/approval', ApprovalApplication::class)->name('application.approval');
//transactions