<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\Activitylog\ActivitylogComponent;
use App\Livewire\Admin\Admin\AdminComponent;
use App\Livewire\Admin\Admin\RoleManagementComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\Auth\LoginComponent;
use App\Livewire\Admin\ContactMessage\ContactMessageComponent;
use App\Livewire\Admin\Filesystem\UploadedFilesComponent;
use App\Livewire\Admin\NumberRenew\RenewComponent;
use App\Livewire\Admin\Settings\ConsoleComponent;
use App\Livewire\Admin\Subscription\SubscritionComponent;
use App\Livewire\Admin\Users\UsersComponent;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Admin" middleware group. Now create something great!
|
*/

Route::get('texttorrent/megCO5LnltDfzkXT/login', LoginComponent::class)->middleware('guest:admin')->name('admin.login');

Route::post('login-as-user', [UsersComponent::class, 'loginAsUser'])->name('loginAsUser');

Route::prefix('texttorrent/megCO5LnltDfzkXT/')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::post('logout', [LogoutController::class, 'adminLogout'])->name('logout');

    Route::get('dashboard', DashboardComponent::class)->name('dashboard');

    // admin routes
    Route::get('all-admins', AdminComponent::class)->name('allAdmins')->middleware('permission:manage_admins');
    Route::get('all-admins/role-permissions', RoleManagementComponent::class)->name('adminRolePermissions')->middleware('permission:manage_roles_permissions');

    // user routes
    Route::get('all-users', UsersComponent::class)->name('allUsers')->middleware('permission:manage_users');

    // settings routes
    Route::get('settings/console', ConsoleComponent::class)->name('console')->middleware('permission:manage_console');

    // Subscription routes
    Route::get('subscriptions', SubscritionComponent::class)->name('subscriptions');

    // Activity log routes
    Route::get('log-activities', ActivitylogComponent::class)->name('logActivities');

    // Renew Alert routes
    Route::get('number-renew-alert', RenewComponent::class)->name('numberRenewAlert');

    // Contact Message routes
    Route::get('contact-message', ContactMessageComponent::class)->name('contact-message');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
