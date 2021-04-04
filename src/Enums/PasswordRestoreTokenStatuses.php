<?php

namespace OZiTAG\Tager\Backend\User\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

class PasswordRestoreTokenStatuses extends Enum
{
    const CREATED = 'CREATED';
    const EXPIRED = 'EXPIRED';
    const SUCCESS = 'SUCCESS';
}
