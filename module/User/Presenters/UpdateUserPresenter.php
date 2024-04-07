<?php

declare(strict_types=1);

namespace Module\User\Presenters;

class UpdateUserPresenter
{
    public function __construct(
        public array $user = []
    ){
    }

    public static function make(): UpdateUserPresenter
    {
        return new self([]);
    }

    public function toArray(): array
    {
        return ['data' => $this->user];
    }
}
