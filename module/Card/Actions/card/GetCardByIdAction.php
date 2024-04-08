<?php

declare(strict_types=1);

namespace Module\Card\Actions\card;

use Exception;
use Module\Abstracts\Action;
use Module\Card\Repositories\Contracts\ICardRepository;

class GetCardByIdAction extends Action
{
    /**
     * @var int
     */
    private int $id;

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
     * @param int $id
     * @return $this
     */
    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return object
     * @throws Exception
     */
    public function execute(): object
    {
        return $this->repository->getById(id: $this->id);
    }
}
