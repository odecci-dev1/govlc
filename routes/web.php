<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;

use App\Http\Livewire\Members\MemberList;

use App\Http\Livewire\Users\UserRegister;
use App\Http\Livewire\Users\Profile;
use App\Http\Livewire\Users\UserList;
use App\Http\Livewire\Transactions\Application\CreateApplication;
use App\Http\Livewire\Transactions\Application\CreditInvestigationApplication;
use App\Http\Livewire\Transactions\Application\CreditInvestigationApplicationList;
use App\Http\Livewire\Transactions\Application\CreateApplicationGroup;
use App\Http\Livewire\Transactions\Application\ApplicationApprovalList;
use App\Http\Livewire\Transactions\Application\ApplicationReleasingList;
use App\Http\Livewire\Transactions\Application\ApplicationList;
use App\Http\Livewire\Transactions\Application\ApplicationPrintingVoucher;
use App\Http\Livewire\Maintenance\FieldOfficer\FieldOfficerlist;
use App\Http\Livewire\Maintenance\FieldOfficer\FieldOfficer;
use App\Http\Livewire\Maintenance\Holiday\HolidayList;
use App\Http\Livewire\Maintenance\Holiday\Holiday;
use App\Http\Livewire\Maintenance\LoanTypes\LoanTypes;
use App\Http\Livewire\Maintenance\LoanTypes\LoanTypesList;
use App\Http\Livewire\Maintenance\FieldArea\FieldArea;
use App\Http\Livewire\Collection\Collection\CollectionList;
use App\Http\Livewire\Collection\Collection\Collection;
use App\Http\Livewire\Collection\Collection\CollectionPrint;
use App\Http\Livewire\Collection\Collection\CollectionRemittance;
use App\Http\Livewire\Reports\OutstandingReport\OutstandingReport;
use App\Http\Livewire\Reports\ReleaseReport\ReleaseReport;
use App\Http\Livewire\Reports\CollectionReport\CollectionReport;
use App\Http\Livewire\Reports\PastDueReport\PastDueReport;
use App\Http\Livewire\Reports\SavingsReport\SavingsReport;
use App\Http\Livewire\Reports\DeclinedApplications\DeclinedApplications;
use App\Http\Livewire\Settings\Settings;
use App\Http\Livewire\Dashboard;
use App\Http\Controllers\ExportsController;
use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Transactions\Application\ApplicationListTrash;
use App\Http\Livewire\Transactions\LoanCalculator\LoanCalculatorList;

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
    return view('login');
});

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/getnoti', [NotificationController::class, 'notifications']);
Route::get('/getnoticount', [NotificationController::class, 'getnoticount']);


Route::get('/test', [NotificationController::class, 'testMe']);
Route::get('/corectRelation', [NotificationController::class, 'corectRelation']);

Route::middleware(['authenticated'])->group(function () {
    Route::get('/notifications//view/{ref}/{id}', [NotificationController::class, 'viewNotification'])->name('viewNotification');
    // Route::get('/notification/view/{id}', [NotificationController::class, 'viewNotification'])->name('viewNotification');
    Route::get('/notification/mark/{notiid}', [NotificationController::class, 'markNotification'])->name('markNotification');

    Route::middleware(['isfo:0'])->group(function () {
        Route::middleware(['access:Module-018'])->group(function () {
            Route::get('/dashboard', Dashboard::class)->name('dashboard');
            
            Route::get('/get/active/members', [DashboardController::class, 'getActiveMembers'])->name('dashboard.sales');
        });

        //members edited
        Route::middleware(['access:Module-019'])->group(function () {
            Route::get('/members', MemberList::class);
            Route::get('/members/{type}/{naID}', CreateApplication::class)->name('application.view');
        });
    });

    Route::middleware(['access:Admin'])->group(function () {
    //user registration
        Route::get('/register', UserRegister::class)->name('user.register');
        Route::get('/users', UserList::class)->name('users');
        Route::get('/user/view/{userid}', UserRegister::class)->name('users');

        Route::get('/settings', Settings::class);
    });

    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    //user registration
    Route::get('/profile', Profile::class)->name('profile');

    //maintenance
    //field officer
    Route::middleware(['access:Module-01'])->group(function () {
        Route::get('/maintenance/fieldofficer/list', FieldOfficerlist::class)->name('fieldofficer.list');
        Route::get('/maintenance/fieldofficer/create', FieldOfficer::class)->name('fieldofficer.create');
        Route::get('/maintenance/fieldofficer/view/{foid}', FieldOfficer::class)->name('fieldofficer.view');
    });
    //field officer

    //holiday
    Route::middleware(['access:Module-04'])->group(function () {
        Route::get('/maintenance/holiday/list', HolidayList::class)->name('holiday.list');
        Route::get('/maintenance/holiday/create', Holiday::class)->name('holiday.create');
        Route::get('/maintenance/holiday/view/{holid}', Holiday::class)->name('holiday.view');
    });
    //holiday

    //loan types
    Route::middleware(['access:Module-03'])->group(function () {
        Route::get('/maintenance/loantypes/list', LoanTypesList::class)->name('loantypes.list');
        Route::get('/maintenance/loantypes/create', LoanTypes::class)->name('loantypes.create');
        Route::get('/maintenance/loantypes/view/{loanid}', LoanTypes::class)->name('loantypes.view');
    });
    //loan types

    //field area
    Route::middleware(['access:Module-02'])->group(function () {
        Route::get('/maintenance/fieldarea', FieldArea::class)->name('fieldarea');
    });
    //field area
    //maintenance

    //transactions
    Route::middleware(['access:Module-08'])->group(function () {
        Route::get('/tranactions/application/list', ApplicationList::class)->name('application.list');
        Route::get('/tranactions/trashed/application/list', ApplicationListTrash::class)->name('application.list.trashed');

        Route::get('/declined/applications', DeclinedApplications::class)->name('application.list');
    });
    Route::middleware(['access:Module-010'])->group(function () {
        Route::get('/tranactions/application/approval/list', ApplicationApprovalList::class)->name('application.approval');
    });

    Route::middleware(['access:Module-011'])->group(function () {
        Route::get('/tranactions/application/releasing/list', ApplicationReleasingList::class)->name('application.approval');
        Route::get('/tranactions/application/passbook/printing/{naID}', function(){
            return view('livewire.transactions.application.application-html-passbook');
        });
        Route::get('/tranactions/application/printing/{naID}', function(){
            return view('livewire.transactions.application.application-html');
        });
    });

    
    Route::middleware(['access:Module-012'])->group(function () {
        Route::get('/transactions/loan-calculator', LoanCalculatorList::class)->name('loancalculator.list');
    });

    Route::middleware(['access:Module-09'])->group(function () {
        Route::get('/tranactions/application/credit/investigation/list', CreditInvestigationApplicationList::class)->name('application.credit.investigation.list');
    });

    Route::middleware(['appviewing'])->group(function () {
        Route::get('/tranactions/application/{type}/{naID}', CreateApplication::class)->name('application.view');
        Route::get('/tranactions/application/{type}', CreateApplication::class)->name('application.create');
    });

    Route::middleware(['access:Module-09'])->group(function () {
        Route::get('/tranactions/application/credit/investigation/view/{memId}', CreditInvestigationApplication::class)->name('application.credit.investigation');
    });

    Route::middleware(['access:Module-08'])->group(function () {    
        Route::get('/tranactions/group/application/{type}/{groupId?}', CreateApplicationGroup::class)->name('application.create.group');
        // Route::get('/tranactions/group/application/{type}', CreateApplicationGroup::class)->name('application.create.group');
    });

    //transactions


    //collection
    Route::middleware(['access:Module-06'])->group(function () {
        Route::get('/collection/list',CollectionList::class);
        Route::get('/collection/create',Collection::class);    
        Route::get('/collection/view/{colrefNo?}/{areaID?}',Collection::class);    
        Route::get('/collection/print/area/{areaID}/{areaRefNo?}', function(){
            return view('livewire.collection.collection.collection-html');
        });
        Route::get('/collection/print/summary/{colrefNo}', function(){
            return view('livewire.collection.collection.collection-summary-html');
        });
    });

    Route::middleware(['access:Module-07'])->group(function () {
        Route::get('/collection/remittance/{foid}/{areaRefNo}/{areaID}',CollectionRemittance::class);
    });
    //collection

    //reports
    Route::middleware(['access:Module-011'])->group(function () {
        Route::get('/outstanding/report', OutstandingReport::class);
    });
    Route::get('/release/report', ReleaseReport::class);
    //Route::get('/export/release/report', [ExportsController::class, 'exportReleaseReport'])->name('export.release.report');

    Route::get('/collection/report', CollectionReport::class);
    Route::get('/savings/report', SavingsReport::class);
    Route::get('/pastdue/report', PastDueReport::class);


});
//reports