<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static ADD()
 * @method static static REMOVE()
 * @method static static REGISTER()
 */
final class OperationType extends Enum
{
    const ADD = 'add';
    const REMOVE = 'remove';
    const REGISTER = 'register_product';
}
