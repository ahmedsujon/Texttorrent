<?php

use App\Http\Controllers\TwilioController;
use App\Livewire\App\InboxComponent;
use App\Livewire\Web\AboutComponent;
use App\Livewire\Web\ContactUsComponent;
use App\Livewire\Web\FeatureComponent;
use App\Livewire\Web\HomeComponent;
use App\Livewire\Web\PricingComponent;
use App\Livewire\Web\PrivacyPolicyComponent;
use App\Livewire\Web\Subscription\PaymentComponent;
use App\Livewire\Web\SubscriptionSuccessComponent;
use App\Livewire\Web\TermsConditionsComponent;
use Illuminate\Support\Facades\Route;

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


Route::get('/', HomeComponent::class)->name('app.home');
Route::get('/features', FeatureComponent::class)->name('app.feature');

Route::get('/pricing', PricingComponent::class)->name('app.pricing');
Route::get('/payment-success', [PricingComponent::class, 'stripePaymentSuccess'])->name('stripePaymentSuccess');
Route::get('/subscription-successful', SubscriptionSuccessComponent::class)->name('app.subscriptionSuccess');


Route::get('/about-us', AboutComponent::class)->name('app.about-us');
Route::get('/contact-us', ContactUsComponent::class)->name('app.contact-us');
Route::get('/privacy-policy', PrivacyPolicyComponent::class)->name('app.privacy-policy');
Route::get('/terms-conditions', TermsConditionsComponent::class)->name('app.terms-conditions');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::post('/twilio/callback', [TwilioController::class, 'twilioStatusCallback'])->name('twilioStatusCallback');


//Call Route Files
require __DIR__ . '/admin.php';
require __DIR__ . '/user.php';
// require __DIR__ . '/web.php';
