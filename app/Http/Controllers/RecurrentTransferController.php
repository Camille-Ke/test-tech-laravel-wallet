<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RecurrentTransferRequest;
use App\Models\RecurrentTransfer;
use Exception;
use Illuminate\Http\Request;

class RecurrentTransferController
{
    public function index(Request $request)
    {
        $recurrentTransfers = $request->user()->wallet->recurrentTransfer()->with('target')->get();
        $balance = $request->user()->wallet->balance;

        return view('recurrent-transfer', compact('balance', 'recurrentTransfers'));
    }

    public function create(RecurrentTransferRequest $request)
    {
        $recipient = $request->getRecipient($request->input('recipient_email'));

        $user = auth()->user();

        try {
            RecurrentTransfer::create([
                'amount' => $request->getAmountInCents(),
                'end_date' => $request->input('end_date'),
                'frequency' => $request->input('frequency'),
                'last_executed_date' => $request->input('last_execution_date'),
                'reason' => $request->input('reason'),
                'source_id' => $user->id,
                'start_date' => $request->input('recipient_email'),
                'target_id' => $recipient->wallet->id,
            ]);

            return redirect()->back()
                ->with('recurent-transfer-status', 'success');
        } catch (Exception $e) {
            // TODO faire sa propre exception
            return redirect()->back()->with('recurent-transfer-status', 'error');
        }

    }

    public function delete(RecurrentTransfer $recurrentTransfer)
    {
        $recurrentTransfer->delete();

        return redirect()->back();
    }
}
