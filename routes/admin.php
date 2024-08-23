<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoutController;
use App\Livewire\Admin\Admin\AdminComponent;
use App\Livewire\Admin\Admin\RoleManagementComponent;
use App\Livewire\Admin\DashboardComponent;
use App\Livewire\Admin\Auth\LoginComponent;
use App\Livewire\Admin\Filesystem\UploadedFilesComponent;
use App\Livewire\Admin\Settings\ConsoleComponent;
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

Route::get('admin/login', LoginComponent::class)->middleware('guest:admin')->name('admin.login');

Route::get('admin', function(){
    return redirect()->route('admin.dashboard');
})->middleware('auth:admin');
Route::prefix('admin/')->name('admin.')->middleware('auth:admin')->group(function(){
    Route::post('logout', [LogoutController::class, 'adminLogout'])->name('logout');

    Route::get('dashboard', DashboardComponent::class)->name('dashboard');

    // admin routes
    Route::get('all-admins', AdminComponent::class)->name('allAdmins')->middleware('permission:manage_admins');
    Route::get('all-admins/role-permissions', RoleManagementComponent::class)->name('adminRolePermissions')->middleware('permission:manage_roles_permissions');

    // user routes
    Route::get('all-users', UsersComponent::class)->name('allUsers')->middleware('permission:manage_users');

    // settings routes
    Route::get('settings/console', ConsoleComponent::class)->name('console')->middleware('permission:manage_console');
});
