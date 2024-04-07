<?php

declare(strict_types=1);

namespace Module\User\Services;

use Exception;
use Module\Abstracts\Service;
use Module\User\Actions\DeleteUserAction;

class DeleteUserService extends Service
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
         app(DeleteUserAction::class)
            ->setId(id: $this->id)
            ->execute();
    }
}
