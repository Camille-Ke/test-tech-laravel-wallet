<?php

declare(strict_types=1);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RecurrentTransferController;
use App\Http\Controllers\SendMoneyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('/send-money', [SendMoneyController::class, '__invoke'])->name('send-money');

    Route::post('/recurrent-transfer', [RecurrentTransferController::class, 'create'])->name('recurrent-transfer.create');
    Route::get('/recurrent-transfer/{recurrentTransfer}', [RecurrentTransferController::class, 'delete'])->name('recurrent-transfer.delete');
    Route::get('/recurrent-transfer', [RecurrentTransferController::class, 'index'])->name('recurrent-transfer');

});

require __DIR__.'/auth.php';
