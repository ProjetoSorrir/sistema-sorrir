<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ExternalApiController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PdfController;
use App\Services\MercadoPagoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

require __DIR__ . '/auth.php';

Route::middleware([
    'web'
])->group(function () {

    Route::get('/', function () {
        //return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
        return view('welcome');
    })->name('welcome');

    //Route::get('/check-payment-status', [MercadoPagoService::class, 'verifyPendingPayments']);

    Route::post('/webhook/mercadopago', function (Request $request, MercadoPagoService $mercadoPagoService) {
        $response = $mercadoPagoService->receivedWebhook($request);
        return response()->json(['message' => $response]);
    })->name('webhook.mercadopago')->withoutMiddleware(['csrf']);

    Route::get('/suporte', function () {
        return view('livewire/site/institutional/support-module');
    })->name('suporte');

    Route::get('/institucional', function () {
        return view('livewire/site/institutional/about-module');
    })->name('institutional');

    Route::get('/winners-page', function () {
        return view('livewire/site/winners-page/winners-page-module');
    })->name('winners-page');

    // Rota para testar a página de erro
    Route::get('/error-page', function () {
        return view('livewire/error-page/error-page-module');
    })->name('error-page');


    Route::get('/ssscscsc', function () {
        return \Illuminate\Support\Facades\Hash::make("123456");
    });
    Route::get('/action/{id}', function ($id) {
        return view('livewire/site/institutional/about-module');
    })->name('raffle-buy');

    // Route::get('/action/{id}', function ($id) {
    //     return view('livewire/site/raffle-buy-module', ['raffleId' => $id]);
    // })->name('raffle-buy');

    Route::get('/login', function () {
        return view('livewire/site/login-module');
    })->name('login');

    Route::get('/register', function () {
        return view('livewire/site/register-module');
    })->name('register');
    Route::post('/consult_cpf', [ExternalApiController::class, 'checkCPF'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class])->name('consult_cpf');

    Route::get('/forget-password', [ForgotPasswordController::class, "forgetPassword"])
        ->name('forget.password');
    Route::post('/forget-password', [ForgotPasswordController::class, "forgetPasswordPost"])
        ->name('forget.password.post');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, "resetPassword"])
        ->name('reset.password');
    Route::post('/reset-password', [ForgotPasswordController::class, "resetPasswordPost"])
        ->name('reset.password.post');

    Route::get('/open-pdf/{filename}', [PdfController::class, 'show'])->name('open-pdf');


    Route::get('/my-buys', function () {
        return view('livewire/site/my-buys-module');
    })->middleware(['auth', 'verified'])->name('my-buys');


    Route::get('/download/invoice/{invoice}', [InvoiceController::class, 'downloadInvoice'])
        ->name('download.invoice');
    //NEED DIVERENT AUTH VERIFY
    Route::get('/reservation-confirmation/{id}', function ($id) {
        return view('livewire/reservation-confirmation-module', ['id' => $id]);
    })->middleware(['IsUser'])->name('reservation-confirmation');

    Route::get('/preparing-reservation/{id}', function ($id) {
        return view('livewire/preparing-reservation-module', ['id' => $id]);
    })->middleware(['IsUser'])->name('preparing-reservation');

    Route::get('/action-premier-win/{id}', function ($id) {
        $ids = explode(',', $id);
        return view('livewire/site/raffle-premier-win-module', ['id' => $ids]);
    })->middleware(['IsUser'])->name('raffle-premier-win');

    Route::get('/refer-dash', function () {
        return view('livewire/site/refer-dash-module');
    })->middleware(['IsUser', 'CheckAdmin'])->name('refer-dash');

    Route::get('/update-profile', function () {
        return view('livewire/profile/update-profile-module');
    })->middleware(['IsUser'])->name('my-profile');

    Route::view('dashboard', 'dashboard')
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::view('profile', 'profile')
        ->middleware(['auth'])
        ->name('profile');

    Route::get('/{code}', function () {
        // The logic here will be handled by the middleware.
    })->middleware('store.referral')->name('store.referral');
});


Route::middleware([
    'web',
])->group(function () {

    Route::middleware([
        'admin'
    ])->group(function () {
        require __DIR__ . '/admin.php';
    });
});