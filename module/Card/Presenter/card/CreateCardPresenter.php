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
        $response = ['message' => 'created successfully'];
        return new self($response);
    }

    public function toArray(): array
    {
        return ['data' => $this->cards];
    }
}
