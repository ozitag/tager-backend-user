<?php

namespace OZiTAG\Tager\Backend\User\Features;

use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Features\Feature;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Requests\ChangePasswordRequest;

class ChangePasswordFeature extends Feature
{
    public function handle(ChangePasswordRequest $request, UserRepository $repository)
    {
        $repository->setById($this->user()->id);

        $repository->fillAndSave([
            'password' => Hash::make($request->newPassword)
        ]);

        return new SuccessResource();
    }
}
