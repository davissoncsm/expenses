<?php

declare(strict_types=1);

namespace Module\Card\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\DTOs\CardDto;
use Module\Card\Presenter\CreateCardPresenter;
use Module\Card\Services\CreateCardService;
use Module\Card\Validation\CardValidation;

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
