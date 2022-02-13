<?php

namespace OZiTAG\Tager\Backend\User\Enums;

enum PasswordRestoreTokenStatuses: string
{
    case CREATED = 'CREATED';
    case EXPIRED = 'EXPIRED';
    case SUCCESS = 'SUCCESS';
}
