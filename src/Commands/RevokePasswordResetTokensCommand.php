<?php

namespace OZiTAG\Tager\Backend\User\Commands;

use Carbon\Carbon;
use OZiTAG\Tager\Backend\Core\Console\Command;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;

class RevokePasswordResetTokensCommand extends Command
{
    public $signature = 'revoke_password_reset_tokens';

    public function handle(UserResetTokenRepository $repository)
    {
        $repository->markOutdatedAsExpired(
            Carbon::now('UTC')->subDay()->format('Y-m-d H:i:s')
        );
    }
}
