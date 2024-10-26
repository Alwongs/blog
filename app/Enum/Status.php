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

    const STATUSES_SHORT = [
        'A' => "Act",
        'D' => "Dis",
    ];
}