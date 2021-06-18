<?php

namespace OZiTAG\Tager\Backend\User\Requests\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Http\FormRequest;
use OZiTAG\Tager\Backend\User\Requests\Base\UserPasswordFormRequest;
use OZiTAG\Tager\Backend\User\Utils\TagerUserConfig;

/**
 * Class CompletePasswordRestoreRequest
 * @package OZiTAG\Tager\Backend\User\Requests\PasswordRestore
 *
 * @property string $token
 */
class CompletePasswordRestoreRequest extends UserPasswordFormRequest
{
    public function rules()
    {
        return array_merge(parent::rules(), [
            'token' => 'required|string',
        ]);
    }
}
