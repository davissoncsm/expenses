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
     * @param object $expense
     * @return $this
     */
    public function setExpense(object $expense): static
    {
        $this->expense = $expense;
        return $this;
    }

    /**
     * @return object
     */
    public function execute(): object
    {
        $user = $this->getUser();
        $message = $this->getMessage();

        $user->notify((new UserExpenseNotification($message)));

        return $user;
    }

    /**
     * @return object
     */
    private function getUser():object
    {
        return $this->expense->card->user;
    }

    private function getMessage(): string
    {
        return 'Você cadastrou uma nova despesa no valor de: R$' . number_format($this->expense->value,2,',', '.');
    }
}
