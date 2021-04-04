<?php

namespace OZiTAG\Tager\Backend\User\Requests\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

/**
 * Class CheckRestoreTokenRequest
 * @package OZiTAG\Tager\Backend\User\Requests\PasswordRestore
 *
 * @property string $token
 * @property string $code
 */
class CheckRestoreTokenWithCodeRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token' => 'required|string',
            'code' => 'required|string',
        ];
    }
}
