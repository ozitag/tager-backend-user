<?php

namespace OZiTAG\Tager\Backend\User\Requests;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;
use OZiTAG\Tager\Backend\User\Validation\Rules\OldPassword;

class ChangePasswordRequest extends FormRequest
{
    public function rules()
    {
        return [
            'oldPassword' => ['required', 'string', new OldPassword()],
            'newPassword' => 'required|string'
        ];
    }
}
