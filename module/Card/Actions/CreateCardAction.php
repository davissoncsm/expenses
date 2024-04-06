<?php

declare(strict_types=1);

namespace Module\Card\Actions;

use Exception;
use Module\Abstracts\Action;
use Module\Card\DTOs\CardDto;
use Module\Card\Repositories\Contracts\ICardRepository;

class CreateCardAction extends Action
{
    /**
     * @var CardDto
     */
    private CardDto $dto;

    public function __construct(
        protected ICardRepository $repository,
    ){
    }

    /**
     * @param CardDto $dto
     * @return $this
     */
    public function setDto(CardDto $dto): static
    {
        $this->dto = $dto;
        return $this;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
        $this->repository->store($this->dto);
    }
}
