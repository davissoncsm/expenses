<?php

declare(strict_types=1);

namespace Module\Card\Actions\expense;

use Module\Abstracts\Action;
use Module\Card\Notifications\UserExpenseNotification;
use Module\User\Repositories\Contracts\IUserRepository;

class EmitAdministratorsExpenseNotificationAction extends Action
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
     * Class instance
     *
     * @param IUserRepository $repository
     */
    public function __construct(
        protected IUserRepository $repository,
    ){
    }

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
        $administrators = $this->getAdministrators();

        foreach ($administrators as $administrator) {
            $administrator->notify((new UserExpenseNotification($message)));
        }
    }

    /**
     * @return object
     */
    private function getAdministrators(): object
    {
        return $this->repository->getAdministrators();
    }

    private function getMessage(): string
    {
        return 'O usuário: '. $this->user->name .
                ', cadastrou uma nova despesa no valor de: R$' .
                number_format($this->expense->value,2,',', '.');
    }
}
