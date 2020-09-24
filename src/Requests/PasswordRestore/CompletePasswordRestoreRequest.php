<?php

namespace OZiTAG\Tager\Backend\User\Requests\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class CompletePasswordRestoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'token' => 'required|string',
            'password' => 'required|string|min:6',
        ];
    }
}
