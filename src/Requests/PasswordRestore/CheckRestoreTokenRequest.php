<?php

namespace OZiTAG\Tager\Backend\User\Requests\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

/**
 * Class CheckRestoreTokenRequest
 * @package OZiTAG\Tager\Backend\User\Requests\PasswordRestore
 *
 * @property string $token
 */
class CheckRestoreTokenRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token' => 'required|string',
        ];
    }
}
