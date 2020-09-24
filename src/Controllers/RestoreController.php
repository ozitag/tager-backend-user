<?php

namespace OZiTAG\Tager\Backend\User\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\CheckPasswordResetTokenFeature;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\CompleteRestorePasswordFeature;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\RestorePasswordFeature;

class RestoreController extends Controller
{
    public function index()
    {
        return $this->serve(RestorePasswordFeature::class);
    }

    public function check()
    {
        return $this->serve(CheckPasswordResetTokenFeature::class);
    }

    public function complete()
    {
        return $this->serve(CompleteRestorePasswordFeature::class);
    }
}
