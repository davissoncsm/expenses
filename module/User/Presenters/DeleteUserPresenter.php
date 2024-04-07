<?php

declare(strict_types=1);

namespace Module\User\Presenters;

class DeleteUserPresenter
{
    public function __construct(
        public array $user = []
    ){
    }

    public static function make(): DeleteUserPresenter
    {
        return new self([]);
    }

    public function toArray(): array
    {
        return ['data' => $this->user];
    }
}
