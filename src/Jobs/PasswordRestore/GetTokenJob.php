<?php

namespace OZiTAG\Tager\Backend\User\Jobs\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreTokenStatuses;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;


class GetTokenJob extends Job
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
     * @param CheckRestoreTokenRequest $request
     * @param UserResetTokenRepository $repository
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|SuccessResource
     */
    public function handle(CheckRestoreTokenRequest $request, UserResetTokenRepository $repository)
    {
        $token = $repository->findToken($request->get('token'));

        if(!$token) {
            return $this->fail('TOKEN_NOT_FOUND', 'Token Not Found');
        }

        switch ($token->status) {
            case PasswordRestoreTokenStatuses::CREATED:
                return $token;
            case PasswordRestoreTokenStatuses::SUCCESS:
                return $this->fail('TOKEN_ALREADY_USED', 'The password has already changed');
            default:
                return $this->fail('TOKEN_EXPIRED', 'Token has already expired');
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
