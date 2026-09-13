<?php

use App\Core\Csrf;

function csrf_field(): string
{
    return (new Csrf())->field();
}
