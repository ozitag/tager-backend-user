<?php

use \OZiTAG\Tager\Backend\User\Enums\PasswordValidationRules;

return [
    'restore' => [
        'password_validation_rules' => [
            PasswordValidationRules::SYMBOLS,
            PasswordValidationRules::LETTERS,
            PasswordValidationRules::NUMBERS,
            PasswordValidationRules::CASE_DIFF,
        ],
        ''
    ],
];
