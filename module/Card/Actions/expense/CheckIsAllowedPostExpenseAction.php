<?php

declare(strict_types=1);

namespace Module\Card\Actions\expense;

use Module\Abstracts\Action;
use Module\Card\DTOs\expense\ExpenseDto;
use Module\Card\Exceptions\InsufficientBalanceException;
use Module\User\Repositories\Contracts\IUserRepository;

class CheckIsAllowedPostExpenseAction extends Action
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
     * Class instance
     *
     * @param IUserRepository $repository
     */
    public function __construct(
        protected IUserRepository $repository,
    ){
    }

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
     * @throws InsufficientBalanceException
     */
    public function execute(): void
    {
        $balance = $this->getUserBalance();

        if($this->dto->value > $balance){
            throw new InsufficientBalanceException('You do not have enough balance to complete this transaction');
        }
    }

    /**
     * @return int
     */
    private function getUserBalance():int
    {
        return $this->user->cards()
                          ->where('id', $this->dto->cardId)
                          ->first()
                          ->limit;
    }
}
