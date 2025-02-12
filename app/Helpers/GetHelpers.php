<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Models\User;

class GetHelper
{
    public static function getRecipient(string $email): User
    {
        return User::where('email', '=', $email)->firstOrFail();
    }

    public static function getAmountInCents(float $amount): int
    {
        return (int) ceil($amount * 100);
    }
}
