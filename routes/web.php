<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Livewire\Users\UserRegister;
use App\Http\Livewire\Users\UserList;
use App\Http\Livewire\Transactions\Application\CreateApplication;
use App\Http\Livewire\Transactions\Application\CreditInvestigationApplication;
use App\Http\Livewire\Transactions\Application\CreditInvestigationApplicationList;
use App\Http\Livewire\Transactions\Application\CreateApplicationGroup;
use App\Http\Livewire\Transactions\Application\ApprovalApplication;
use App\Http\Livewire\Transactions\Application\ApplicationList;
use App\Http\Livewire\Maintenance\FieldOfficer\FieldOfficerlist;
use App\Http\Livewire\Maintenance\FieldOfficer\FieldOfficer;
use App\Http\Livewire\Maintenance\Holiday\HolidayList;
use App\Http\Livewire\Maintenance\Holiday\Holiday;
use App\Http\Livewire\Maintenance\LoanTypes\LoanTypes;
use App\Http\Livewire\Maintenance\LoanTypes\LoanTypesList;
use App\Http\Livewire\Maintenance\FieldArea\FieldArea;


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
    // return redirect()->intended(route('dashboard'));
    return view('login');
});

Route::get('/dashboard', function(){
    return view('dashboard');
})->name('dashboard');


Route::get('/test', [DashboardController::class, 'test']);
Route::get('/posttest', [DashboardController::class, 'posttest']);

//user registration
Route::get('/register', UserRegister::class)->name('user.register');
Route::get('/users', UserList::class)->name('users');
Route::get('/user/view/{userid}', UserRegister::class)->name('users');
Route::post('/login', [LoginController::class, 'login'])->name('login');
//user registration

//maintenance
//field officer
Route::get('/maintenance/fieldofficer/list', FieldOfficerlist::class)->name('fieldofficer.list');
Route::get('/maintenance/fieldofficer/create', FieldOfficer::class)->name('fieldofficer.create');
Route::get('/maintenance/fieldofficer/view/{foid}', FieldOfficer::class)->name('fieldofficer.view');
//field officer

//holiday
Route::get('/maintenance/holiday/list', HolidayList::class)->name('holiday.list');
Route::get('/maintenance/holiday/create', Holiday::class)->name('holiday.create');
Route::get('/maintenance/holiday/view/{holid}', Holiday::class)->name('holiday.view');
//holiday

//loan types
Route::get('/maintenance/loantypes/list', LoanTypesList::class)->name('loantypes.list');
Route::get('/maintenance/loantypes/create', LoanTypes::class)->name('loantypes.create');
//loan types

//field area
Route::get('/maintenance/fieldarea', FieldArea::class)->name('fieldarea');
//field area
//maintenance

//transactions
Route::get('/tranactions/application/list', ApplicationList::class)->name('application.list');
Route::get('/tranactions/application/create/{type}', CreateApplication::class)->name('application.create');
Route::get('/tranactions/application/view/{memId}/{type}', CreateApplication::class)->name('application.view');
Route::get('/tranactions/application/create/{memId}/{type}', CreateApplication::class)->name('application.view');
Route::get('/tranactions/application/group/create', CreateApplicationGroup::class)->name('application.create.group');
Route::get('/tranactions/application/credit/investigation/list', CreditInvestigationApplicationList::class)->name('application.credit.investigation.list');
Route::get('/tranactions/application/credit/investigation/view/{memId}', CreditInvestigationApplication::class)->name('application.credit.investigation');
Route::get('/tranactions/application/approval', ApprovalApplication::class)->name('application.approval');
//transactions