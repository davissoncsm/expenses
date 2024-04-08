<?php

declare(strict_types=1);

namespace Module\Card\Presenter;

class UpdateCardPresenter
{
    public function __construct(
        public array $card = []
    ){
    }

    public static function make(): UpdateCardPresenter
    {
        return new self([]);
    }

    public function toArray(): array
    {
        return ['data' => $this->card];
    }
}
