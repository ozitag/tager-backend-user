<?php

namespace OZiTAG\Tager\Backend\User\Enums;

enum PasswordRestoreMode: string
{
    case Link = 'LINK';
    case Code = 'CODE';
}
