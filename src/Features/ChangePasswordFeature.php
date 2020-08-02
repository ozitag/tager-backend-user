<?php

namespace OZiTAG\Tager\Backend\User\Features;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Requests\ChangePasswordRequest;

class ChangePasswordFeature extends Feature
{
    public function handle(ChangePasswordRequest $request)
    {
        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();

        return new SuccessResource();
    }
}
