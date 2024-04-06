<?php

declare(strict_types=1);

namespace Module\User\Repositories\Contracts;

use Module\User\DTOs\LoginDto;

interface IUserRepository
{
    /**
     * @param LoginDto $dto
     * @return object|null
     */
    public function getUserByEmail(LoginDto $dto): object|null;
}
