<?php

namespace OZiTAG\Tager\Backend\User\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

class PasswordValidationRules extends Enum
{
    const NUMBERS = 'numbers';
    const LETTERS = 'letters';
    const SYMBOLS = 'symbols';
    const CASE_DIFF = 'case_diff';
}
