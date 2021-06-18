<?php

use OZiTAG\Tager\Backend\User\Enums\PasswordValidationRule;

return [
    'password_validation_rules' => [
        'min:8',
        PasswordValidationRule::HasLetters,
        PasswordValidationRule::HasNumbers,
        PasswordValidationRule::HasSymbols,
        PasswordValidationRule::HasCaseDiff,
    ],

    'password_validation_messages' => [
        /*
        'min' => 'Should be minimum 8 symbols',
        PasswordValidationRule::HasLetters => 'Must contain letters',
        PasswordValidationRule::HasNumbers => 'Must contain numbers',
        PasswordValidationRule::HasSymbols => 'Must contain symbols',
        PasswordValidationRule::HasCaseDiff => 'Must contain capitalize and lowercase letters',
        */
    ],
];
