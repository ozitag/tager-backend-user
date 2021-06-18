<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Models\User;
use OZiTAG\Tager\Backend\User\Repositories\UserRepository;

class LogoutUserJob extends Job
{
    protected User $user;

    protected bool $allDevices;

    public function __construct(?User $user = null, bool $allDevices = false)
    {
        $this->user = $user ?: Auth::user();

        $this->allDevices = $allDevices;
    }

    public function handle(UserRepository $repository)
    {
        $userToken = $this->user->token();

        if ($userToken) {
            $userToken->revoke();
        }

        if ($this->allDevices) {
            DB::table('oauth_access_tokens')->where('user_id', $this->user->id)->update([
                'revoked' => true
            ]);
        }
    }
}
