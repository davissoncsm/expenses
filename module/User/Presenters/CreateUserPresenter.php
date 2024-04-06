<?php

declare(strict_types=1);

namespace Module\User\Presenters;

class CreateUserPresenter
{
    public function __construct(
        public array $user = []
    ){
    }

    public static function make(): CreateUserPresenter
    {
        $presenter = ['message' => 'success'];
        return new self($presenter);
    }

    public function toArray(): array
    {
        return ['data' => $this->user];
    }
}
