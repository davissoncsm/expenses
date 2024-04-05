<?php

declare(strict_types=1);

namespace Module\User\Services\Auth;

use Module\User\Actions\Auth\LoginAction;
use Module\User\DTOs\Auth\LoginDto;
use Module\User\Services\Service;

class LoginService extends Service
{

    /**
     * @var LoginDto
     */
    private LoginDto $dto;

    /***
     * @param LoginDto $dto
     * @return $this
     */
    public function setDto(LoginDto $dto): static
    {
        $this->dto = $dto;
        return $this;
    }

    /**
     * @return mixed
     */
    public function execute(): string
    {
        return app(LoginAction::class)
                ->setLoginDto(dto: $this->dto)
                ->execute();
    }
}
