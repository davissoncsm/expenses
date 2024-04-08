<?php

declare(strict_types=1);

namespace Module\Card\Actions\expense;

use Module\Abstracts\Action;
use Module\Card\DTOs\expense\ExpenseDto;
use Module\Card\Repositories\Contracts\IExpenseRepository;

class CreateExpenseAction extends Action
{

    /**
     * @var ExpenseDto
     */
    private ExpenseDto $dto;

    /**
     * Class instance
     *
     * @param IExpenseRepository $repository
     */
    public function __construct(
        protected IExpenseRepository $repository,
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
     * @return mixed
     * @throws \Exception
     */
    public function execute(): object
    {
        return $this->repository->store(dto: $this->dto);
    }
}
