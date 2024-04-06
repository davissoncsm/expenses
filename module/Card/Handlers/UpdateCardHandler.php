<?php

declare(strict_types=1);

namespace Module\Card\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\DTOs\CardDto;
use Module\Card\Services\UpdateCardService;
use Module\Card\Validation\CardValidation;

class UpdateCardHandler
{
    /**
     * @param CardValidation $validation
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(CardValidation $validation): JsonResponse
    {
        $dto = CardDto::makeFromValidation(validation: $validation);

        (new UpdateCardService())
            ->setDto(dto: $dto)
            ->execute();

        return response()->json([], 204);
    }
}
