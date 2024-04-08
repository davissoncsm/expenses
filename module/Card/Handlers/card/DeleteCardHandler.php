<?php

declare(strict_types=1);

namespace Module\Card\Handlers\card;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\Services\card\DeleteCardService;
use Module\Card\Validation\card\CardValidation;

class DeleteCardHandler
{
    /**
     * @param int $id
     * @param CardValidation $validation
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(int $id, CardValidation $validation): JsonResponse
    {
        (new DeleteCardService())
            ->setId(id: $id)
            ->execute();

        return response()->json([], 204);
    }
}
