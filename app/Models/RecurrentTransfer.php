<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecurrentTransfer extends Model
{
    protected $fillable = [
        'amount',
        'end_date',
        'frequency',
        'last_executed_date',
        'reason',
        'source_id',
        'start_date',
        'target_id',
    ];

    /**
     * @return BelongsTo<User>
     */
    public function source(): BelongsTo
    {
        return $this->belongsTo(User::class, 'source_id');
    }

    /**
     * @return BelongsTo<User>
     */
    public function target(): BelongsTo
    {
        return $this->belongsTo(User::class, 'target_id');
    }
}
