<?php

namespace OZiTAG\Tager\Backend\User\Requests;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function rules()
    {
        $user = Auth::user();

        return [
            'name' => 'required|string',
            'email' => ['required', 'string', 'email', 'unique:tager_users,email,' . $user->id]
        ];
    }
}
