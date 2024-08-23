<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\App\Auth\LoginComponent;
use App\Http\Controllers\LogoutController;
use App\Livewire\App\User\DashboardComponent;
use App\Livewire\App\Auth\RegistrationComponent;
use App\Livewire\App\CalendarComponent;
use App\Livewire\App\Campaigns\BatchQueueComponent;
use App\Livewire\App\Campaigns\BulkMessageComponent;
use App\Livewire\App\Campaigns\ContactMessageQueueComponent;
use App\Livewire\App\Campaigns\GroupQueueComponent;
use App\Livewire\App\Campaigns\InboxTemplateComponent;
use App\Livewire\App\ClaimsComponent;
use App\Livewire\App\Contacts\ManageContactsComponent;
use App\Livewire\App\Contacts\ValidatorCreditsComponent;
use App\Livewire\App\InboxComponent;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register User routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "User" middleware group. Now create something great!
|
*/

Route::get('/login', LoginComponent::class)->name('login')->middleware('guest');
Route::get('/register', RegistrationComponent::class)->name('register')->middleware('guest');

Route::get('user', DashboardComponent::class)->middleware('auth:user');

Route::get('/', DashboardComponent::class)->name('app.home')->middleware('auth');
Route::name('user.')->middleware('auth')->group(function(){
    Route::post('logout', [LogoutController::class, 'userLogout'])->name('logout');

    Route::get('dashboard', DashboardComponent::class)->name('dashboard');

    Route::get('claims', ClaimsComponent::class)->name('claims');
    Route::get('inbox', InboxComponent::class)->name('inbox');
    Route::get('contacts/manage', ManageContactsComponent::class)->name('contacts.manage');

    Route::get('contacts/validator-credits', ValidatorCreditsComponent::class)->name('contacts.validatorCredits');
    Route::get('contacts/validator-credits', ValidatorCreditsComponent::class)->name('contacts.validatorCredits');

    Route::get('campaigns/send-bulk-message', BulkMessageComponent::class)->name('campaigns.sendBulkMessage');
    Route::get('campaigns/group-queue', GroupQueueComponent::class)->name('campaigns.groupQueue');
    Route::get('campaigns/contact-message-queue', ContactMessageQueueComponent::class)->name('campaigns.contactMessageQueue');
    Route::get('campaigns/batch-queue', BatchQueueComponent::class)->name('campaigns.batchQueue');
    Route::get('campaigns/inbox-template', InboxTemplateComponent::class)->name('campaigns.inboxTemplate');

    Route::get('calendar', CalendarComponent::class)->name('calendar');
});
