<?php

namespace OZiTAG\Tager\Backend\User\Exceptions;

use Throwable;

class UserEmailBusyException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('tager-user::messages.email_is_busy'), $code, $previous);
    }
}
