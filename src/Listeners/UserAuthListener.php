<?php

namespace OZiTAG\Tager\Backend\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Request;
use Laravel\Passport\Events\AccessTokenCreated;
use Laravel\Passport\Token;
use Laravel\Passport\TokenRepository;
use OZiTAG\Tager\Backend\Auth\Scopes\TokenProviderScope;
use OZiTAG\Tager\Backend\User\Repositories\UserAuthLogRepository;

class UserAuthListener implements ShouldQueue
{
    /**
     * @var AdminAuthLogRepository
     */
    private $repository;

    /**
     * Create the event listener.
     *
     * @param UserAuthLogRepository $repository
     */
    public function __construct(UserAuthLogRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param AccessTokenCreated $event
     * @param TokenRepository $repository
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $token = Token::withoutGlobalScope(TokenProviderScope::class)->whereId($event->tokenId)->first();

        if (!$token || $token->provider !== 'users') {
            return;
        }

        $this->repository->fillAndSave([
            'user_id' => $event->userId,
            'ip' => Request::ip() ?? '-'
        ]);
    }
}
