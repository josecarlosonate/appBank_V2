<?php

namespace App\Enums;

enum AccountRegistrationResult
{
    case SUCCESS;
    case ACCOUNT_NOT_FOUND;
    case OWN_ACCOUNT;
    case ALREADY_REGISTERED;
    case REGISTRATION_FAILED;
}
