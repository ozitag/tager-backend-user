<?php

namespace OZiTAG\Tager\Backend\User\Features;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;

class LogoutFeature extends Feature
{
    public function handle()
    {
        Auth::user()->token()->revoke();
        return new SuccessResource();
    }
}
