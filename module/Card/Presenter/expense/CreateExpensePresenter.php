<?php

declare(strict_types=1);

namespace Module\Card\Presenter\expense;

class CreateExpensePresenter
{
    public function __construct(
        public array $expense = []
    ){
    }

    public static function make(array $cards = []): CreateExpensePresenter
    {
        return new self($cards);
    }

    public function toArray(): array
    {
        return ['data' => $this->expense];
    }
}
