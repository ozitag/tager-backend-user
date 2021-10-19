<?php

namespace OZiTAG\Tager\Backend\User\Features\PasswordRestore;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Exceptions\UserPasswordPolicyException;
use OZiTAG\Tager\Backend\User\Jobs\PasswordRestore\GetTokenJob;
use OZiTAG\Tager\Backend\User\Models\UserResetToken;
use OZiTAG\Tager\Backend\User\Operations\RestoreUserPasswordOperation;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CompletePasswordRestoreRequest;
use OZiTAG\Tager\Backend\User\Utils\TagerUserConfig;
use OZiTAG\Tager\Backend\Validation\Facades\Validation;

class CompleteRestorePasswordFeature extends Feature
{
    /**
     * @param CompletePasswordRestoreRequest $request
     * @return mixed|SuccessResource
     */
    public function handle(CompletePasswordRestoreRequest $request)
    {
        $token = $this->run(GetTokenJob::class, [
            'token' => $request->get('token')
        ]);

        if (!($token instanceof UserResetToken)) {
            return $token;
        }

        $user = $token->user;

        try {
            $this->run(RestoreUserPasswordOperation::class, [
                'token' => $token,
                'password' => $request->get('password')
            ]);
        } catch (UserPasswordPolicyException $exception) {
            Validation::throw('password', $exception->getMessage());
        }

        return new JsonResource([
            'email' => $user->email
        ]);
    }
}
