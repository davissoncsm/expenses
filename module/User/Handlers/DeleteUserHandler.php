<?php

declare(strict_types=1);

namespace Module\User\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\User\Presenters\DeleteUserPresenter;
use Module\User\Services\DeleteUserService;

class DeleteUserHandler
{
    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(int $id): JsonResponse
    {

        (new DeleteUserService())
                ->setId(id: $id)
                ->execute();

        return response()->json(DeleteUserPresenter::make()->toArray(), 204);
    }
}
