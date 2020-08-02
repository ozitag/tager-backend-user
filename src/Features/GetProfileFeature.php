<?php

namespace OZiTAG\Tager\Backend\User\Features;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\User\Resources\ProfileResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class GetProfileFeature extends Feature
{
    public function handle()
    {
        return new ProfileResource(Auth::user());
    }
}
