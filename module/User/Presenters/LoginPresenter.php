<?php

declare(strict_types=1);

namespace Module\User\Presenters;

class LoginPresenter
{
    public function __construct(
        public array $login = []
    ){
    }

    public static function make(string $token): LoginPresenter
    {
        $presenter = ['token' => $token];
        return new self($presenter);
    }

    public function toArray(): array
    {
        return ['data' => $this->login];
    }
}
