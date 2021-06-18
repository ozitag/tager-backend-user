<?php

namespace OZiTAG\Tager\Backend\User\Jobs\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Models\User;

class LogoutUserJob extends Job
{
    protected User $user;

    protected string $provider;

    protected bool $allDevices;

    public function __construct(?User $user = null, ?string $provider = null, bool $allDevices = true)
    {
        $this->user = $user ?: Auth::user();

        $this->provider = $provider ?: Config::get('auth.guards.api.provider');

        $this->allDevices = $allDevices;
    }

    public function handle()
    {
        $userToken = $this->user->token();

        if ($userToken) {
            $userToken->revoke();
        }

        if ($this->allDevices) {
            DB::table('oauth_access_tokens')
                ->where('user_id', $this->user->id)->where('provider', $this->provider)
                ->update([
                    'revoked' => true
                ]);
        }
    }
}
