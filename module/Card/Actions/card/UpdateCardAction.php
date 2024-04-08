<?php

declare(strict_types=1);

namespace Module\Card\Actions\card;

use Exception;
use Module\Abstracts\Action;
use Module\Card\DTOs\card\CardDto;
use Module\Card\Repositories\Contracts\ICardRepository;

class UpdateCardAction extends Action
{
    /**
     * @var CardDto
     */
    private CardDto $dto;

    /**
     * Class instance
     *
     * @param ICardRepository $repository
     */
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
        $this->repository->update($this->dto);
    }
}
