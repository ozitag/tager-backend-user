<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Enums\PasswordValidationRule;
use OZiTAG\Tager\Backend\User\Exceptions\UserPasswordPolicyException;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\Base\UserPasswordFormRequest;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;
use OZiTAG\Tager\Backend\User\Utils\TagerUserConfig;

class UpdateUserPasswordJob extends Job
{
    protected string $password;

    protected int $userId;

    public function __construct(string $password, int $userId)
    {
        $this->password = $password;

        $this->userId = $userId;
    }

    public function handle(UserRepository $repository)
    {
        $user = $repository->setById($this->userId);
        if (!$user) {
            throw new \Exception('User not found');
        }

        $rules = TagerUserConfig::getPasswordValidationRules();
        $message = TagerUserConfig::getPasswordValidationMessages();

        $request = new UserPasswordFormRequest();
        $request->merge([
            'password' => $this->password,
        ]);

        try {
            $request->validate([
                'password' => $rules,
            ]);
        } catch (ValidationException $exception) {
            throw new UserPasswordPolicyException($exception->errors()['password']);
        }

        $repository->fillAndSave([
            'password' => Hash::make($this->password)
        ]);
    }

}
