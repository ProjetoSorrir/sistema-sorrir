<?php

use App\Services\MovedRaffleService;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/admin/home', function () {
    return view('livewire/admin/home-module');
})->middleware(['auth', 'admin'])->name('home');

Route::get('/admin/my-profile', function () {
    return view('livewire/admin/profile/my-profile-module');
})->name('admin.my_profile');

Route::get('/admin/actions', function () {
    return view('livewire/admin/my-raffles-module');
})->name('my_raffles');

Route::get('/admin/actions/create', function () {
    return view('livewire/admin/raffle/create-module');
})->name('my_raffles.create');

Route::get('/admin/actions/edit/{id}', function ($id) {
    return view('livewire/admin/raffle/edit-module', ['id' => $id]);
})->name('edit-raffles');

Route::get('/admin/actions/winner/{id}', function ($id) {
    return view('livewire/admin/raffle/raffle-winner-numbers-module', ['id' => $id]);
})->name('winner-raffles');

Route::get('/admin/actions/premier/{id}', function ($id) {
    return view('livewire/admin/raffle/raffle-premier-numbers-module', ['id' => $id]);
})->name('premier-raffles');

Route::get('/admin/customers', function () {
    return view('livewire/admin/customer-module');
})->name('customers');

Route::get('/admin/customer/edit/{id}', function ($id) {
    return view('livewire/admin/customer/edit-customer-module', ['id' => $id]);
})->name('edit-customer');

Route::get('/admin/winners', function () {
    return view('livewire/admin/winners-module');
})->name('winners');

Route::get('/admin/messages', function () {
    return view('livewire/admin/wpp-messages-module');
})->name('messages');

Route::get('/admin/affiliates', function () {
    return view('livewire/admin/affiliates-module');
})->name('affiliates');

Route::get('/admin/affiliates/affiliates-extract', function () {
    return view('livewire/admin/affiliates/affiliates-extract-module');
})->name('affiliates-extract');

Route::get('/admin/payment-request', function () {
    return view('livewire/admin/payment-request-module');
})->name('payment-request');

Route::get('/admin/panel', function () {
    return view('livewire/admin/list-panel-module');
})->name('panel');

Route::get('/admin/slide/create', function () {
    return view('livewire/admin/slide/create-slide-module');
})->name('slide_create');

Route::get('/admin/edit-site', function () {
    return view('livewire/admin/edit-site-module');
})->name('edit-site');

Route::get('/admin/pedidos', function () {
    return view('livewire/admin/pedidos-module');
})->name('pedidos');

Route::get('/admin/faq', function () {
    return view('livewire/admin/faq/faq-table-module');
})->name('faq');

Route::get('/admin/doc', function () {
    return view('livewire/admin/components-documentation');
})->name('doc');

Route::get('/admin/use-terms', function () {
    return view('livewire/admin/legal-terms/use-term-module');
})->name('use-terms');



Route::get('/admin/duplicate', function (Request $request) {
    $id = $request->query('id', null);
    $modev = new MovedRaffleService();
    if ($id) {
        return $modev->cloneAndDeleteRaffle($id);
    } else {
        return 'no-id';
    }
})->name('duplicateRaffle');