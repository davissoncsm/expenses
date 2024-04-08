<?php

declare(strict_types=1);

namespace Module\Card\Handlers\card;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\DTOs\card\CardDto;
use Module\Card\Presenter\CreateCardPresenter;
use Module\Card\Services\card\CreateCardService;
use Module\Card\Validation\card\CardValidation;

class CreateCardHandler
{
    /**
     * @param CardValidation $validation
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(CardValidation $validation): JsonResponse
    {
        $dto = CardDto::makeFromValidation(validation: $validation);

        (new CreateCardService())
            ->setDto(dto: $dto)
            ->execute();

        return response()->json(CreateCardPresenter::make()->toArray(), 201);
    }
}
