<?php
namespace OZiTAG\Tager\Backend\User\Enums;


class PasswordValidationRules extends \OZiTAG\Tager\Backend\Core\Enums\Enum
{
    const NUMBERS = 'numbers';
    const LETTERS = 'letters';
    const SYMBOLS = 'symbols';
    const CASE_DIFF = 'case_diff';
}
