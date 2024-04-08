<?php

declare(strict_types=1);

namespace Module\Card\Presenter\card;

class CreateCardPresenter
{
    public function __construct(
        public array $cards = []
    ){
    }

    public static function make(array $cards = []): CreateCardPresenter
    {
        return new self($cards);
    }

    public function toArray(): array
    {
        return ['data' => $this->cards];
    }
}
