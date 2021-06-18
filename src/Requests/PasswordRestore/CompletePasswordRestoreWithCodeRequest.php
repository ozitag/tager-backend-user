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
 * @property string $code
 */
class CompletePasswordRestoreWithCodeRequest extends UserPasswordFormRequest
{
    public function rules()
    {
        return [
            'token' => 'required|string',
            'code' => 'required|string',
        ];
    }
}
