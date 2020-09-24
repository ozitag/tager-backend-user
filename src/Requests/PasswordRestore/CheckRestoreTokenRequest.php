<?php

namespace OZiTAG\Tager\Backend\User\Requests\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class CheckRestoreTokenRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token' => 'required|string'
        ];
    }
}
