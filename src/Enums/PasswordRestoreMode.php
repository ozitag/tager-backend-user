<?php

namespace OZiTAG\Tager\Backend\User\Enums;

use OZiTAG\Tager\Backend\Core\Enums\Enum;

class PasswordRestoreMode extends Enum
{
    const Link = 'LINK';
    const Code = 'CODE';
}
