<?php

namespace OZiTAG\Tager\Backend\User\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

class PasswordValidationRule extends Enum
{
    const HasNumbers = 'has_numbers';
    const HasLetters = 'has_letters';
    const HasSymbols = 'has_symbols';
    const HasCaseDiff = 'has_case_diff';
}
