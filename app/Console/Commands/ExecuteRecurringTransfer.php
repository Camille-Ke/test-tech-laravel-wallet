<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\RecurrentTransfer;
use Illuminate\Console\Command;

class ExecuteRecurringTransfer extends Command
{
    //TODO ajout commande au scheduler
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:execute-recurring-transfer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $transfers = RecurrentTransfer::wherePast('start_date')
            ->whereFuture('end_date');

        foreach ($transfers as $transfer) {
            if (! $transfer->last_executed_date) {
                // TODO Execute transfer
                $transfer->last_executed_date = now();
                $transfer->save();
            } elseif ($transfer->last_executed_date->diffInDays(now()) <= $transfer->frequency) {
                // TODO Execute transfer
                $transfer->last_executed_date = now();
                $transfer->save();
            }
        }
    }
}
