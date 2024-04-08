<?php

declare(strict_types=1);

namespace Module\User\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\Presenter\card\DeleteCardPresenter;
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

        return response()->json(DeleteCardPresenter::make()->toArray(), 204);
    }
}
