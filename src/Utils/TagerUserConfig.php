<?php

namespace OZiTAG\Tager\Backend\User\Utils;

use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreMode;
use OZiTAG\Tager\Backend\User\Enums\PasswordValidationRule;

class TagerUserConfig
{
    private static function config($param = null, $default = null)
    {
        return \config('tager-user' . (empty($param) ? '' : '.' . $param), $default);
    }

    public static function getRestoreMode(): PasswordRestoreMode
    {
        $result = self::config('restore.mode');

        if (!$result) {
            return PasswordRestoreMode::Link;
        }

        if (is_string($result)) {
            $result = PasswordRestoreMode::tryFrom($result);
            if (!$result) {
                throw new \Exception('Invalid restore mode');
            }
        }

        if ($result instanceof PasswordRestoreMode === false) {
            throw new \Exception('Invalid restore mode');
        }

        return $result;
    }

    public static function getPasswordValidationRules(): array
    {
        $configRules = self::config('password_validation_rules', []);

        $result = [];
        foreach ($configRules as $configRule) {
            if ($configRule instanceof PasswordValidationRule) {
                $result[] = $configRule->value;
            } else {
                $result[] = $configRule;
            }
        }

        return $result;
    }

    public static function getPasswordValidationMessages(): array
    {
        return self::config('password_validation_messages', []);
    }
}
