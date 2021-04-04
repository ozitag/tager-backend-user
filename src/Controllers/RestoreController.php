<?php

namespace OZiTAG\Tager\Backend\User\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\User\Utils\TagerUserConfig;
use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreMode;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\CheckPasswordResetTokenFeature;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\CheckPasswordResetTokenWithCodeFeature;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\CompleteRestorePasswordFeature;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\CompleteRestorePasswordWithCodeFeature;
use OZiTAG\Tager\Backend\User\Features\PasswordRestore\RestorePasswordFeature;

class RestoreController extends Controller
{
    public function index()
    {
        return $this->serve(RestorePasswordFeature::class);
    }

    public function check()
    {
        if (TagerUserConfig::getRestoreMode() == PasswordRestoreMode::Code) {
            return $this->serve(CheckPasswordResetTokenWithCodeFeature::class);
        } else {
            return $this->serve(CheckPasswordResetTokenFeature::class);
        }
    }

    public function complete()
    {
        if (TagerUserConfig::getRestoreMode() == PasswordRestoreMode::Code) {
            return $this->serve(CompleteRestorePasswordWithCodeFeature::class);
        } else {
            return $this->serve(CompleteRestorePasswordFeature::class);
        }
    }
}
