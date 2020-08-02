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
        $user = Auth::user();

        $check = Hash::check($request->oldPassword, $user->password);

        if (!$check) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    'oldPassword' => [
                        'code' => 'INVALID_PASSWORD',
                        'message' => 'Invalid password'
                    ]
                ],
            ], 400));
        }

        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();

        return new SuccessResource();
    }
}
