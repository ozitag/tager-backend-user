<?php

namespace OZiTAG\Tager\Backend\User\Utils;

use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreMode;

class TagerUserConfig
{
    private static function config($param = null, $default = null)
    {
        return \config('tager-user' . (empty($param) ? '' : '.' . $param), $default);
    }

    public static function getRestoreMode(): string
    {
        $result = self::config('restore.mode', PasswordRestoreMode::Link);

        if (!in_array($result, PasswordRestoreMode::getValues())) {
            throw new \Exception('Invalid Restore Mode');
        }

        return $result;
    }

    public static function getPasswordValidationRules(): array
    {
        return self::config('password_validation_rules', []);
    }

    public static function getPasswordValidationMessages(): array
    {
        return self::config('password_validation_messages', []);
    }
}
