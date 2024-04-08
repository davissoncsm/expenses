<?php

declare(strict_types=1);

namespace Module\Card\Presenter\card;

class DeleteCardPresenter
{
    public function __construct(
        public array $card = []
    ){
    }

    public static function make(): DeleteCardPresenter
    {
        return new self([]);
    }

    public function toArray(): array
    {
        return ['data' => $this->card];
    }
}
