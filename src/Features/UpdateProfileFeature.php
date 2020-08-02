<?php

namespace OZiTAG\Tager\Backend\User\Features;

use Illuminate\Support\Facades\Auth;
use OZiTAG\Tager\Backend\User\Requests\UpdateProfileRequest;
use OZiTAG\Tager\Backend\User\Resources\ProfileResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class UpdateProfileFeature extends Feature
{
    public function handle(UpdateProfileRequest $request)
    {
        $user = Auth::user();

        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();

        return new ProfileResource($user);
    }
}
