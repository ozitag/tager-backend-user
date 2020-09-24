<?php

namespace OZiTAG\Tager\Backend\User\Jobs\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;


class GetUserByResetTokenJob extends Job
{
    protected string $token;

    /**
     * RevokeUserResetTokensJob constructor.
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param UserResetTokenRepository $repository
     */
    public function handle(UserResetTokenRepository $repository)
    {
        $token = $repository->findActiveToken($this->token);

        if(!$token) {

        }
    }

    /**
     * @param string $code
     * @param string $message
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    protected function fail(string $code, string $message) {
        return response([
            'success' => false,
            'errorCode' => $code,
            'errorMessage' => $message,
        ]);
    }
}
