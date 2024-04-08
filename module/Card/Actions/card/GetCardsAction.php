<?php

declare(strict_types=1);

namespace Module\Card\Actions\card;

use Exception;
use Module\Abstracts\Action;
use Module\Card\Repositories\Contracts\ICardRepository;

class GetCardsAction extends Action
{
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
     * @return array
     * @throws Exception
     */
    public function execute(): array
    {
        return $this->repository->getAll();
    }
}
