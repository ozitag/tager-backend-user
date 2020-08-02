<?php

namespace OZiTAG\Tager\Backend\User\Controllers;

use OZiTAG\Tager\Backend\Core\Controllers\Controller;
use OZiTAG\Tager\Backend\User\Features\ChangePasswordFeature;
use OZiTAG\Tager\Backend\User\Features\GetProfileFeature;
use OZiTAG\Tager\Backend\User\Features\LogoutFeature;
use OZiTAG\Tager\Backend\User\Features\UpdateProfileFeature;

class ProfileController extends Controller
{
    public function index()
    {
        return $this->serve(GetProfileFeature::class);
    }

    public function update()
    {
        return $this->serve(UpdateProfileFeature::class);
    }

    public function changePassword()
    {
        return $this->serve(ChangePasswordFeature::class);
    }

    public function logout()
    {
        return $this->serve(LogoutFeature::class);
    }
}
