<?php

declare(strict_types=1);

namespace Module\Card\Presenter;

class GetCardsPresenter
{
    public function __construct(
        public array $cards = []
    ){
    }

    public static function make(array $cards = []): GetCardsPresenter
    {
        $data = [];

        foreach ($cards as $key => $card) {
            $data[$key] = $card;
        }
        return new self($data);
    }

    public function toArray(): array
    {
        return ['data' => $this->cards];
    }
}
