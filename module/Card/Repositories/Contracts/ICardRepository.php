<?php

declare(strict_types=1);

namespace Module\Card\Repositories\Contracts;

interface ICardRepository
{
    /**
     * @param object $card
     * @param int $value
     * @return void
     */
    public function updateCardLimit(object $card, int $value): void;
}
