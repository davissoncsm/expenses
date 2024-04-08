<?php

declare(strict_types=1);

namespace Module\Card\Services\expense;

use Module\Abstracts\Service;
use Module\Card\Actions\expense\CheckIsAllowedPostExpenseAction;
use Module\Card\Actions\expense\CreateExpenseAction;
use Module\Card\Actions\expense\EmitAdministratorsExpenseNotificationAction;
use Module\Card\Actions\expense\EmitUserExpenseNotificationAction;
use Module\Card\DTOs\expense\ExpenseDto;
use Module\Card\Events\UpdateBalanceEvent;

class CreateExpenseService extends Service
{
    /**
     * @var ExpenseDto
     */
    private ExpenseDto $dto;

    /**
     * @var object
     */
    private object $user;

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
     * @param object $user
     * @return $this
     */
    public function setUser(object $user): static
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->checkIsAllowedPostExpense();

        $expense = $this->createExpense();
        $this->emitUserNotification(expense: $expense);
        $this->emitAdministratorsNotification(expense: $expense);
        $this->updateCardLimit(expense: $expense);
    }

    /**
     * @return void
     */
    private function checkIsAllowedPostExpense(): void
    {
        app(CheckIsAllowedPostExpenseAction::class)
            ->setUser(user: $this->user)
            ->setDto(dto: $this->dto)
            ->execute();
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
     * @return void
     */
    private function emitUserNotification(object $expense): void
    {
        app(EmitUserExpenseNotificationAction::class)
            ->setExpense(expense: $expense)
            ->setUser(user: $this->user)
            ->execute();
    }

    /**
     * @param object $expense
     * @return void
     */
    private function emitAdministratorsNotification(object $expense): void
    {
        app(EmitAdministratorsExpenseNotificationAction::class)
            ->setExpense(expense: $expense)
            ->setUser(user: $this->user)
            ->execute();
    }

    /**
     * @param object $expense
     * @return void
     */
    private function updateCardLimit(object $expense): void
    {
        $card = $expense->card;
        event(new UpdateBalanceEvent(card: $card, value: $expense->value));
    }
}
