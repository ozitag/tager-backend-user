<?php

namespace OZiTAG\Tager\Backend\User\Features\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
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

        if ($user) {
            $this->run(RestoreTokenOperation::class, [
                'user' => $user
            ]);
        }

        return new SuccessResource();
    }
}
