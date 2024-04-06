<?php

declare(strict_types=1);

namespace Module\Card\Services;

use Exception;
use Module\Abstracts\Service;
use Module\Card\Actions\CreateCardAction;
use Module\Card\DTOs\CardDto;

class CreateCardService extends Service
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
        app(CreateCardAction::class)
            ->setDto(dto: $this->dto)
            ->execute();
    }
}
