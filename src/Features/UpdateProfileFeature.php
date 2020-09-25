<?php

namespace OZiTAG\Tager\Backend\User\Features;

use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Requests\UpdateProfileRequest;
use OZiTAG\Tager\Backend\User\Resources\ProfileResource;
use OZiTAG\Tager\Backend\Core\Features\Feature;

class UpdateProfileFeature extends Feature
{
    public function handle(UpdateProfileRequest $request, UserRepository $repository)
    {
        $repository->setById($this->user()->id);

        $user = $repository->fillAndSave([
            'email' => $request->get('email'),
            'name' => $request->get('name'),
        ]);

        return new ProfileResource($user);
    }
}
