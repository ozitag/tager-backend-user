<?php

namespace OZiTAG\Tager\Backend\User\Exceptions;

use Throwable;

class UserPasswordPolicyException extends \Exception
{
    protected array $errors = [];
    
    public function __construct(array $errors = [])
    {
        parent::__construct(__('tager-user::messages.password_policy_error'));

        $this->errors = $errors;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
