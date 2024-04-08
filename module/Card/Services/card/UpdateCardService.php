<?php

declare(strict_types=1);

namespace Module\Card\Services\card;

use Exception;
use Module\Abstracts\Service;
use Module\Card\Actions\card\UpdateCardAction;
use Module\Card\DTOs\card\CardDto;

class UpdateCardService extends Service
{

    /**
     * @var CardDto
     */
    private CardDto $dto;

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
        app(UpdateCardAction::class)
            ->setDto(dto: $this->dto)
            ->execute();
    }
}
