<?php

namespace OZiTAG\Tager\Backend\User\Requests\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

/**
 * Class CompletePasswordRestoreRequest
 * @package OZiTAG\Tager\Backend\User\Requests\PasswordRestore
 *
 * @property string $token
 * @property string $password
 * @property string $code
 */
class CompletePasswordRestoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token' => 'required|string',
            'code' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }
}
