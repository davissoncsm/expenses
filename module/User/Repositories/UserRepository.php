<?php

declare(strict_types=1);

namespace Module\User\Repositories;

use App\Entities\UserEntity;
use App\Repositories\BaseRepository;
use Module\User\DTOs\Auth\LoginDto;
use Module\User\Repositories\Contracts\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * @return string
     */
    public function entity(): string
    {
        return UserEntity::class;
    }

    /**
     * @param LoginDto $dto
     * @return object|null
     */
    public function getUserByEmail(LoginDto $dto): object|null
    {
        return $this->entity
                    ->where('email', $dto->email)
                    ->first();
    }
}
