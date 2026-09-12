<?php

namespace App\Enums;

enum AccountRegistrationResult
{
    case SUCCESS;
    case ACCOUNT_NOT_FOUND;
    case OWN_ACCOUNT;
    case ALREADY_REGISTERED;
    case REGISTRATION_FAILED;

    public function message(): string
    {
        return match ($this) {
            self::SUCCESS => 'La cuenta de tercero fue inscrita correctamente.',
            self::ACCOUNT_NOT_FOUND => 'La cuenta o el documento no coinciden.',
            self::OWN_ACCOUNT => 'No puedes inscribir una cuenta propia.',
            self::ALREADY_REGISTERED => 'Esta cuenta ya está inscrita.',
            self::REGISTRATION_FAILED => 'No fue posible inscribir la cuenta.',
        };
    }
}
