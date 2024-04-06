<?php

declare(strict_types=1);

namespace Module\Card\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\Services\DeleteCardService;

class DeleteCardHandler
{
    /**
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(int $id): JsonResponse
    {
        (new DeleteCardService())
            ->setId(id: $id)
            ->execute();

        return response()->json([], 204);
    }
}
