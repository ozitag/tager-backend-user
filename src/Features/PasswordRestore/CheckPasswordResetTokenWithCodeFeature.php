<?php

namespace OZiTAG\Tager\Backend\User\Features\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Jobs\PasswordRestore\GetTokenJob;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenWithCodeRequest;
use OZiTAG\Tager\Backend\Core\Validation\Facades\Validation;

class CheckPasswordResetTokenWithCodeFeature extends Feature
{
    public function handle(CheckRestoreTokenWithCodeRequest $request)
    {
        /** @var UserResetToken $token */
        $token = $this->run(GetTokenJob::class, [
            'token' => $request->token,
            'code' => $request->code
        ]);

        if ($token instanceof UserResetToken) {
            return new SuccessResource();
        }

        Validation::throw('token', 'Invalid Token');
    }
}
