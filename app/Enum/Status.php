<?php

namespace App\Enum;

/**
 * ImagePairTypes contains possible values for images types
 *
 * @package Tygh\Enum
 */
class Status
{
    const ACTIVE = 'A';
    const DISABLE = 'D';

    const STATUSES = [
        'A' => "Active",
        'D' => "Disable",
    ];
}