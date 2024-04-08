<?php

declare(strict_types=1);

namespace Module\Card\Services\expense;

use Module\Abstracts\Service;
use Module\Card\Actions\expense\CreateExpenseAction;
use Module\Card\Actions\expense\EmitAdministratorsExpenseNotificationAction;
use Module\Card\Actions\expense\EmitUserExpenseNotificationAction;
use Module\Card\DTOs\expense\ExpenseDto;

class CreateExpenseService extends Service
{
    /**
     * @var ExpenseDto
     */
    private ExpenseDto $dto;

    /**
     * @param ExpenseDto $dto
     * @return $this
     */
    public function setDto(ExpenseDto $dto): static
    {
        $this->dto = $dto;
        return $this;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $expense = $this->createExpense();
        $user = $this->emitUserNotification(expense: $expense);
        $this->emitAdministratorsNotification(user: $user, expense: $expense);

    }

    /**
     * @return object
     */
    private function createExpense(): object
    {
        return app(CreateExpenseAction::class)
            ->setDto(dto: $this->dto)
            ->execute();
    }

    /**
     * @param object $expense
     * @return object
     */
    private function emitUserNotification(object $expense): object
    {
        return app(EmitUserExpenseNotificationAction::class)
            ->setExpense(expense: $expense)
            ->execute();
    }

    /**
     * @param object $user
     * @param object $expense
     * @return void
     */
    private function emitAdministratorsNotification(object $user, object $expense): void
    {
        app(EmitAdministratorsExpenseNotificationAction::class)
            ->setExpense(expense: $expense)
            ->setUser(user: $user)
            ->execute();
    }
}
