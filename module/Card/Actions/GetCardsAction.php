<?php

declare(strict_types=1);

namespace Module\Card\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Module\Abstracts\Action;
use Module\Card\Repositories\Contracts\ICardRepository;

class GetCardsAction extends Action
{
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
