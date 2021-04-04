<?php

namespace OZiTAG\Tager\Backend\User\Jobs\PasswordRestore;

use OZiTAG\Tager\Backend\Core\Jobs\Job;
use OZiTAG\Tager\Backend\Core\Resources\SuccessResource;
use OZiTAG\Tager\Backend\User\Enums\PasswordRestoreTokenStatuses;
use OZiTAG\Tager\Backend\User\Repositories\UserResetTokenRepository;
use OZiTAG\Tager\Backend\User\Requests\PasswordRestore\CheckRestoreTokenRequest;
use OZiTAG\Tager\Backend\Validation\Facades\Validation;

class GetTokenJob extends Job
{
    protected string $token;

    protected ?string $code;

    /**
     * RevokeUserResetTokensJob constructor.
     * @param string $token
     */
    public function __construct(string $token, ?string $code = null)
    {
        $this->token = $token;

        $this->code = $code;
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

                if ($token->code != $this->code) {
                    Validation::throw('code', __('tager-user::messages.invalid_code'));
                }

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
