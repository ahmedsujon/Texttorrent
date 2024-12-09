<?php

use App\Livewire\App\HomeComponent;
use App\Livewire\App\InboxComponent;
use App\Livewire\App\ClaimsComponent;
use Illuminate\Support\Facades\Route;
use App\Livewire\App\CalendarComponent;
use App\Livewire\App\Auth\LoginComponent;
use App\Http\Controllers\LogoutController;
use App\Livewire\App\Settings\ApiComponent;
use App\Livewire\App\Settings\LogsComponent;
use App\Livewire\App\User\DashboardComponent;
use App\Livewire\App\Auth\NewPasswordComponent;
use App\Livewire\App\Auth\RegistrationComponent;
use App\Livewire\App\Settings\GetNumberComponent;
use App\Livewire\App\Settings\MyAccountComponent;
use App\Livewire\App\Auth\ForgetPasswordComponent;
use App\Livewire\App\Settings\SubAccountComponent;
use App\Livewire\App\Campaigns\BatchQueueComponent;
use App\Livewire\App\Campaigns\GroupQueueComponent;
use App\Livewire\App\Campaigns\BulkMessageComponent;
use App\Livewire\App\Settings\ActiveNumberComponent;
use App\Livewire\App\Settings\NotificationComponent;
use App\Livewire\App\Settings\SubscriptionComponent;
use App\Livewire\App\Campaigns\InboxTemplateComponent;
use App\Livewire\App\Contacts\ManageContactsComponent;
use App\Livewire\App\Settings\ChangePasswordComponent;
use App\Livewire\App\Settings\DLCRegistrationComponent;
use App\Livewire\App\Contacts\ValidatorCreditsComponent;
use App\Livewire\App\Settings\SubscriptionAlertComponent;
use App\Livewire\App\Settings\DLCCampaignPaymentComponent;
use App\Livewire\App\Campaigns\ContactMessageQueueComponent;
use App\Livewire\App\Settings\ApiAlertComponent;
use App\Livewire\App\Settings\BulkLogsComponent;

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

Route::get('buy-credit-for-text-torrent-sms-mms-secret-gateway-wxd-uft-8uga-qqw-sop-999', [DashboardComponent::class, 'buyCreditSuccess'])->name('user.buyCreditSuccess');
Route::name('user.')->middleware('auth')->group(function () {
    Route::post('logout', [LogoutController::class, 'userLogout'])->name('logout');

    Route::get('dashboard', DashboardComponent::class)->name('dashboard');

    Route::get('claims', ClaimsComponent::class)->name('claims');
    Route::get('inbox', InboxComponent::class)->name('inbox');

    Route::get('contacts/manage', ManageContactsComponent::class)->name('contacts.manage');
    Route::get('contacts/validator-credits', ValidatorCreditsComponent::class)->name('contacts.validatorCredits');

    Route::get('campaigns/send-bulk-message', BulkMessageComponent::class)->name('campaigns.sendBulkMessage');
    Route::get('campaigns/group-queue', GroupQueueComponent::class)->name('campaigns.groupQueue');
    Route::get('campaigns/contact-message-queue', ContactMessageQueueComponent::class)->name('campaigns.contactMessageQueue');
    Route::get('campaigns/batch-queue', BatchQueueComponent::class)->name('campaigns.batchQueue');
    Route::get('campaigns/inbox-template', InboxTemplateComponent::class)->name('campaigns.inboxTemplate');

    Route::get('calendar', CalendarComponent::class)->name('calendar');

    // DCL Campaign Registration Payment
    Route::get('campaign/registration/payment', DLCCampaignPaymentComponent::class)->name('campaignRegistrationPayment');


    // Settings Routes
    Route::get('settings/my-account', MyAccountComponent::class)->name('myAccount');
    Route::get('settings/change-password', ChangePasswordComponent::class)->name('changePassword');
    Route::get('settings/subscription', SubscriptionComponent::class)->name('subscription');
    Route::get('settings/subscription/alert', SubscriptionAlertComponent::class)->name('subscriptionAlertSubAccount');
    Route::get('settings/api/alert', ApiAlertComponent::class)->name('apiAlertSubAccount');

    Route::get('settings/sub-account', SubAccountComponent::class)->name('subAccount');
    Route::get('settings/get-number', GetNumberComponent::class)->name('getNumber')->middleware('subscription');
    Route::get('settings/active-numbers', ActiveNumberComponent::class)->name('activeNumber');
    Route::get('settings/inbox-logs', LogsComponent::class)->name('inboxLogs');
    Route::get('settings/bulk-logs', BulkLogsComponent::class)->name('bulkLogs');
    Route::get('settings/apis', ApiComponent::class)->name('apis')->middleware('subscription');
    Route::get('settings/dlc-registration', DLCRegistrationComponent::class)->name('dlcRegistration')->middleware('subscription');
    Route::get('settings/trigger-notification', NotificationComponent::class)->name('triggerNotification');

    // ajax
    Route::get('get-live-calender-events', [CalendarComponent::class, 'getEventsProperty'])->name('getCalEvents');
});

// Forget Password
Route::get('user/password/reset', ForgetPasswordComponent::class)->name('user.reset.password');
Route::get('user/change/password', NewPasswordComponent::class)->name('user.change.password');
