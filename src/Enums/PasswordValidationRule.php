<?php

namespace OZiTAG\Tager\Backend\User\Enums;

enum PasswordValidationRule:string
{
    case HasNumbers = 'has_numbers';
    case HasLetters = 'has_letters';
    case HasSymbols = 'has_symbols';
    case HasCaseDiff = 'has_case_diff';
}
