<?php

namespace App\Observers;

use App\Models\Wallet;
use App\Mail\WalletBalanceLow;
use Illuminate\Support\Facades\Mail;

class WalletObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(Wallet $wallet): void
    {
        if($wallet->isDirty('balance') && $wallet->balance < 1000 ) {
            Mail::to($wallet->user)->send(new WalletBalanceLow());
        }
    }
}
