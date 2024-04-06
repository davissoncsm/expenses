<?php

declare(strict_types=1);

namespace Module\User\Services;

use Module\Abstracts\Service;
use Module\User\Actions\LoginAction;
use Module\User\DTOs\LoginDto;

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
