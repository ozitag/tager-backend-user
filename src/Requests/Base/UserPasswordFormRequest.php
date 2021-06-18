<?php

namespace OZiTAG\Tager\Backend\User\Requests\Base;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;
use OZiTAG\Tager\Backend\User\Utils\TagerUserConfig;

/**
 * @property string $password
 */
class UserPasswordFormRequest extends FormRequest
{
    public function rules()
    {
        return [
            'password' => ['required', 'string', ...TagerUserConfig::getPasswordValidationRules()]
        ];
    }

    public function messages()
    {
        $result = [];

        foreach (TagerUserConfig::getPasswordValidationMessages() as $rule => $message) {
            $result['password.' . $rule] = $message;
        }

        return $result;
    }
}
