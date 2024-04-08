<?php

declare(strict_types=1);

namespace Module\Card\Handlers\card;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\Card\DTOs\card\CardDto;
use Module\Card\Presenter\card\UpdateCardPresenter;
use Module\Card\Services\card\UpdateCardService;
use Module\Card\Validation\card\CardValidation;

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

        return response()->json(UpdateCardPresenter::make()->toArray(), 204);
    }
}
