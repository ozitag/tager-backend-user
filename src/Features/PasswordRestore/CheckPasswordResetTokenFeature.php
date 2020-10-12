<?php

namespace OZiTAG\Tager\Backend\User\Features\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Jobs\PasswordRestore\GetTokenJob;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;

class CheckPasswordResetTokenFeature extends Feature
{
    /**
     * @return SuccessResource
     */
    public function handle(CheckRestoreTokenRequest $request)
    {
        $token = $this->run(GetTokenJob::class, [
            'token' => $request->get('token')
        ]);

        if($token instanceof UserResetToken) {
            return new SuccessResource();
        }
        
        return $token;
    }
}
