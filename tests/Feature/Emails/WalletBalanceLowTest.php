<?php

declare(strict_types=1);

use App\Models\User;
use App\Models\Wallet;
use App\Mail\WalletBalanceLow;
use Illuminate\Support\Facades\Mail;



test('notification send when balance is < 10', function () {
    Mail::fake();

    $user = User::factory()->has(Wallet::factory()->balance(1100))->create();
    $wallet = $user->wallet;
    $wallet->decrement('balance', 200);

    expect($user->wallet->refresh()->balance)->toBe(900);
    Mail::assertSent(WalletBalanceLow::class);

});
