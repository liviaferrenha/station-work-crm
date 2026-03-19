<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/leads', [LeadController::class, 'index'])->name('leads.index');
Route::get('/leads/create', [LeadController::class, 'create'])->name('leads.create');
Route::post('/leads', [LeadController::class, 'store'])->name('leads.store');
Route::post('/leads/import', [LeadController::class, 'import'])->name('leads.import');