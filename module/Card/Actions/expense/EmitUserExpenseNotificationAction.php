<?php

declare(strict_types=1);

namespace Module\Card\Actions\expense;

use Module\Abstracts\Action;
use Module\Card\Notifications\UserExpenseNotification;

class EmitUserExpenseNotificationAction extends Action
{

    /**
     * @var object
     */
    private object $expense;

    /**
     * @var object
     */
    private object $user;

    /**
     * @param object $expense
     * @return $this
     */
    public function setExpense(object $expense): static
    {
        $this->expense = $expense;
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
        $message = $this->getMessage();
        $this->user->notify((new UserExpenseNotification($message)));
    }

    /**
     * @return string
     */
    private function getMessage(): string
    {
        return 'Você cadastrou uma nova despesa no valor de: R$' . number_format($this->expense->value,2,',', '.');
    }
}
