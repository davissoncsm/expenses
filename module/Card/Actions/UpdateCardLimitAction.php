<?php

declare(strict_types=1);

namespace Module\Card\Actions;

use Module\Abstracts\Action;
use Module\Card\Repositories\Contracts\ICardRepository;

class UpdateCardLimitAction extends Action
{

    /**
     * @var object
     */
    private object $card;

    /**
     * @var int
     */
    private int $value;

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
     * @param object $card
     * @return $this
     */
    public function setCard(object $card): static
    {
        $this->card = $card;
        return $this;
    }

    /**
     * @param int $value
     * @return $this
     */
    public function setValue(int $value): static
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $limit = $this->card->limit - $this->value;

        $this->repository->updateCardLimit(card: $this->card, value: $limit);
    }
}
