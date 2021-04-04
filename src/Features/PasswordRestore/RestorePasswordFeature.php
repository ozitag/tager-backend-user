<?php

namespace OZiTAG\Tager\Backend\User\Features\PasswordRestore;

use Illuminate\Http\Resources\Json\JsonResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Utils\TagerUserConfig;
use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreMode;
use OZiTAG\Tager\Backend\User\Operations\RestoreTokenOperation;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\PasswordRestoreRequest;

class RestorePasswordFeature extends Feature
{
    /**
     * @param UserRepository $repository
     * @param PasswordRestoreRequest $request
     * @return SuccessResource
     */
    public function handle(UserRepository $repository, PasswordRestoreRequest $request)
    {
        $user = $repository->findByEmail(
            $request->get('email')
        );

        $token = null;
        if ($user) {
            $token = $this->run(RestoreTokenOperation::class, [
                'user' => $user
            ]);
        }

        if(TagerUserConfig::getRestoreMode() == PasswordRestoreMode::Code){
            return new JsonResource([
                'token' => $token ? $token->token : null
            ]);
        }

        return new SuccessResource();
    }
}
