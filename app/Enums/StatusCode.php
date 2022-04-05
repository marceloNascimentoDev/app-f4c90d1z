<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static INTERNAL_ERROR()
 * @method static static SUCCESS()
 * @method static static UNPROCESSABLE_CONTENT()
 */
final class StatusCode extends Enum
{
    const ERROR = 500;
    const SUCCESS = 200;
    const UNPROCESSABLE_CONTENT = 422;
}
