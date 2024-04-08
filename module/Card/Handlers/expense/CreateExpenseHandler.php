<?php

declare(strict_types=1);

namespace Module\Card\Handlers\expense;

use Module\Card\DTOs\expense\ExpenseDto;
use Module\Card\Services\expense\CreateExpenseService;
use Module\Card\Validation\expense\ExpenseValidation;

class CreateExpenseHandler
{
    public function __invoke(ExpenseValidation $validation)
    {
        $dto = ExpenseDto::makeFromValidation(validation: $validation);

        app(CreateExpenseService::class)
            ->setDto(dto: $dto)
            ->setUser(user: auth()->user())
            ->execute();
    }
}
