<?php

declare(strict_types=1);

namespace Module\User\Response;

class LoginResponse
{
    public function __construct(
        public string $token,
    ){
    }

    public function response(): array
    {
        return [
            'data' => [
                'token' => $this->token
            ]
        ];
    }
}
