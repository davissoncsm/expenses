<?php

declare(strict_types=1);

namespace Module\Card\Handlers\expense;

use Illuminate\Http\JsonResponse;
use Module\Card\DTOs\expense\ExpenseDto;
use Module\Card\Presenter\expense\CreateExpensePresenter;
use Module\Card\Services\expense\CreateExpenseService;
use Module\Card\Validation\expense\ExpenseValidation;

class CreateExpenseHandler
{
    /**
     * @param ExpenseValidation $validation
     * @return JsonResponse
     */
    public function __invoke(ExpenseValidation $validation): JsonResponse
    {
        $dto = ExpenseDto::makeFromValidation(validation: $validation);

        app(CreateExpenseService::class)
            ->setDto(dto: $dto)
            ->setUser(user: auth()->user())
            ->execute();

        return response()->json(CreateExpensePresenter::make()->toArray(), 201);
    }
}
