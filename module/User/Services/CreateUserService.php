<?php

declare(strict_types=1);

namespace Module\User\Services;

use Exception;
use Module\Abstracts\Service;
use Module\User\Actions\CreateUserAction;
use Module\User\DTOs\UserDto;

class CreateUserService extends Service
{

    /**
     * @var UserDto
     */
    private UserDto $dto;

    /***
     * @param UserDto $dto
     * @return $this
     */
    public function setDto(UserDto $dto): static
    {
        $this->dto = $dto;
        return $this;
    }

    /**
     * @return void
     * @throws Exception
     */
    public function execute(): void
    {
         app(CreateUserAction::class)
            ->setUserDto(dto: $this->dto)
            ->execute();
    }
}
