<?php

declare(strict_types=1);

namespace Module\Card\Services;

use Exception;
use Module\Abstracts\Service;
use Module\Card\Actions\DeleteCardAction;

class DeleteCardService extends Service
{

    /**
     * @var int
     */
    private int $id;

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
        app(DeleteCardAction::class)
            ->setId(id: $this->id)
            ->execute();
    }
}
