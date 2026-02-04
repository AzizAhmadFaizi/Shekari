<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeAttachmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VehicleAttachmentController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VicePresidentController;
use App\Http\Controllers\WeaponAttachmentController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\WeaponPaymentController;
use App\Http\Controllers\WeaponPrintController;
use App\Http\Controllers\ShekariWeaponController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Illuminate\Support\Facades\Auth::routes();

Route::get('/', function () {
    return view('auth.login');
})->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::middleware('role:1')->group(function () {
        Route::post('/user-update', [RegisterController::class, 'update'])->name('user-update');
    });

    // users
    Route::get('/user-profile', [RegisterController::class, 'profile'])->name('user-profile');
    Route::post('/update-profile', [RegisterController::class, 'update_profile'])->name('update-profile');

    Route::middleware(['role:2,4'])->group(function () {
        // organization
        Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations');
        Route::get('/shops', [OrganizationController::class, 'shops'])->name('shops');
        Route::post('/organization-store', [OrganizationController::class, 'store'])->name('organization-store');
        Route::get('/organization-deactive/{id?}', [OrganizationController::class, 'deactive'])->name('organization-deactive');
        Route::get('/organization-approve/{id?}', [OrganizationController::class, 'approve'])->name('organization-approve');
        Route::get('/organization-reject/{id?}', [OrganizationController::class, 'reject'])->name('organization-reject');
        Route::get('/organization-general-form/{organization_id?}', [OrganizationController::class, 'show_general_form'])->name('organization-general-form');
        Route::get('/organization-details/{organization_id}', [OrganizationController::class, 'show'])->name('organization-details');

        // presidents
        Route::get('/presidents/{organization_id?}', [PresidentController::class, 'index'])->name('presidents');
        Route::post('/president-store', [PresidentController::class, 'store'])->name('president-store');
        Route::post('/president-deactive', [PresidentController::class, 'deactive'])->name('president-deactive');
        Route::get('/president-approve/{id?}', [PresidentController::class, 'approve'])->name('president-approve');
        Route::get('/president-reject/{id?}', [PresidentController::class, 'reject'])->name('president-reject');

        // vice presidents
        Route::get('/vice-presidents/{organization_id?}', [VicePresidentController::class, 'index'])->name('vice-presidents');
        Route::post('/vice-president-store', [VicePresidentController::class, 'store'])->name('vice-president-store');
        Route::post('/vice-president-deactive', [VicePresidentController::class, 'deactive'])->name('vice-president-deactive');
        Route::get('/vice-president-approve/{id?}', [VicePresidentController::class, 'approve'])->name('vice-president-approve');
        Route::get('/vice-president-reject/{id?}', [VicePresidentController::class, 'reject'])->name('vice-president-reject');

        // to get districts according to province
        Route::get('/province_districts', [OrganizationController::class, 'province_districts'])->name('province_districts');

        // license
        Route::get('/licenses/{organization_id?}', [LicenseController::class, 'index'])->name('licenses');
        Route::post('/license-store', [LicenseController::class, 'store'])->name('license-store');
        Route::post('/license-deactive', [LicenseController::class, 'deactive'])->name('license-deactive');
        Route::get('/license-print/{license_id}', [LicenseController::class, 'print'])->name('license-print');
        Route::get('/license-printed/{license_id?}', [LicenseController::class, 'printed'])->name('license-printed');
        Route::get('/license-approve/{id?}', [LicenseController::class, 'approve'])->name('license-approve');
        Route::get('/license-reject/{id?}', [LicenseController::class, 'reject'])->name('license-reject');

        // vehicles
        Route::get('/vehicles/{organization_id?}', [VehicleController::class, 'index'])->name('vehicles');
        Route::post('/vehicle-store', [VehicleController::class, 'store'])->name('vehicle-store');
        Route::post('/vehicle-deactive', [VehicleController::class, 'deactive'])->name('vehicle-deactive');
        Route::get('/vehicle-approve/{id?}', [VehicleController::class, 'approve'])->name('vehicle-approve');
        Route::get('/vehicle-reject/{id?}', [VehicleController::class, 'reject'])->name('vehicle-reject');

        // weapon attachments
        Route::get('/vehicle-attachments/{organization_id}', [VehicleAttachmentController::class, 'index'])->name('vehicle-attachments');
        Route::post('/vehicle-attachment-store', [VehicleAttachmentController::class, 'store'])->name('vehicle-attachment-store');
        Route::get('/vehicle-attachment-approve/{id?}', [VehicleAttachmentController::class, 'approve'])->name('vehicle-attachment-approve');
        Route::get('/vehicle-attachment-reject/{id?}', [VehicleAttachmentController::class, 'reject'])->name('vehicle-attachment-reject');

        // contracts
        Route::get('/contracts/{organization_id?}', [ContractController::class, 'index'])->name('contracts');
        Route::post('/contract-store', [ContractController::class, 'store'])->name('contract-store');
        Route::post('/contract-deactive', [ContractController::class, 'deactive'])->name('contract-deactive');
        Route::get('/contract-completed/{contract_id?}', [ContractController::class, 'contract_completed'])->name('contract-completed');
        Route::get('/contract-approve/{id?}', [ContractController::class, 'approve'])->name('contract-approve');
        Route::get('/contract-reject/{id?}', [ContractController::class, 'reject'])->name('contract-reject');

        // employees
        Route::get('/employees/{organization_id?}', [EmployeeController::class, 'index'])->name('employees');
        Route::post('/employee-store', [EmployeeController::class, 'store'])->name('employee-store');
        Route::post('/employee-deactive', [EmployeeController::class, 'deactive'])->name('employee-deactive');
        Route::get('/employee-approve/{id?}', [EmployeeController::class, 'approve'])->name('employee-approve');
        Route::get('/employee-reject/{id?}', [EmployeeController::class, 'reject'])->name('employee-reject');
        Route::get('/employee-fired-list/{organization_id}', [EmployeeController::class, 'fired_employees'])->name('employee-fired-list');

        // employee payments
        Route::get('/employee-payments/{organization_id}', [EmployeePaymentController::class, 'index'])->name('employee-payments');
        Route::post('/employee-payment-store', [EmployeePaymentController::class, 'store'])->name('employee-payment-store');
        Route::get('/employee-payment-approve/{id?}', [EmployeePaymentController::class, 'approve'])->name('employee-payment-approve');
        Route::get('/employee-payment-reject/{id?}', [EmployeePaymentController::class, 'reject'])->name('employee-payment-reject');

        // employee attachments
        Route::get('/employee-attachments/{organization_id}', [EmployeeAttachmentController::class, 'index'])->name('employee-attachments');
        Route::post('/employee-attachment-store', [EmployeeAttachmentController::class, 'store'])->name('employee-attachment-store');
        Route::get('/employee-attachment-approve/{id?}', [EmployeeAttachmentController::class, 'approve'])->name('employee-attachment-approve');
        Route::get('/employee-attachment-reject/{id?}', [EmployeeAttachmentController::class, 'reject'])->name('employee-attachment-reject');

        // weapons
        Route::get('/weapons/{organization_id?}', [WeaponController::class, 'index'])->name('weapons');
        Route::post('/weapon-store', [WeaponController::class, 'store'])->name('weapon-store');
        Route::post('/weapon-deactive', [WeaponController::class, 'deactive'])->name('weapon-deactive');
        Route::post('/weapon-payment-store', [WeaponPaymentController::class, 'store'])->name('weapon-payment-store');
        Route::post('/weapon-send-print', [WeaponController::class, 'send_to_print'])->name('weapon-send-print');
        Route::get('/weapon-printed/{organization_id?}', [WeaponPrintController::class, 'weapon_printed'])->name('weapon-printed');
        Route::get('/weapon-approve/{id?}', [WeaponController::class, 'approve'])->name('weapon-approve');
        Route::get('/weapon-reject/{id?}', [WeaponController::class, 'reject'])->name('weapon-reject');

        // weapon attachments
        Route::get('/weapon-attachments/{organization_id}', [WeaponAttachmentController::class, 'index'])->name('weapon-attachments');
        Route::post('/weapon-attachment-store', [WeaponAttachmentController::class, 'store'])->name('weapon-attachment-store');
        Route::get('/weapon-attachment-approve/{id?}', [WeaponAttachmentController::class, 'approve'])->name('weapon-attachment-approve');
        Route::get('/weapon-attachment-reject/{id?}', [WeaponAttachmentController::class, 'reject'])->name('weapon-attachment-reject');

        // weapon payments
        Route::get('/weapon-payments/{organization_id}', [WeaponPaymentController::class, 'index'])->name('weapon-payments');
        Route::get('/weapon-payment-approve/{id?}', [WeaponPaymentController::class, 'approve'])->name('weapon-payment-approve');
        Route::get('/weapon-payment-reject/{id?}', [WeaponPaymentController::class, 'reject'])->name('weapon-payment-reject');
        Route::get('/unused-weapons-list/{organization_id}', [WeaponController::class, 'unused_weapons'])->name('unused-weapons-list');

        Route::get('/report', [ReportController::class, 'index'])->name('report');

        // shekari weapons
        Route::get('/shekari-weapons', [ShekariWeaponController::class, 'index'])->name('shekari-weapons');
        Route::post('/shekari-weapon-store', [ShekariWeaponController::class, 'store'])->name('shekari-weapon-store');
        Route::get('/shekari-weapon-delete/{id?}', [ShekariWeaponController::class, 'delete'])->name('shekari-weapon-delete');
        Route::get('/shekari-weapon-report', [ShekariWeaponController::class, 'report'])->name('shekari-weapon-report');
    });

    Route::get('/show-weapon-to-print', [WeaponPrintController::class, 'index'])->name('show-weapon-to-print');
    Route::middleware('role:3')->group(function () {
        Route::get('/weapon-print/{organization_id}', [WeaponPrintController::class, 'print_weapon_card'])->name('weapon-print');
    });
});
