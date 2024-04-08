<?php
declare(strict_types=1);

namespace Module\User\Actions;

use Exception;
use Module\Abstracts\Action;
use Module\User\DTOs\UserDto;
use Module\User\Repositories\Contracts\IUserRepository;

class UpdateUserAction extends  Action
{

    /**
     * @var UserDto
     */
    private UserDto $dto;

    /**
     * Class instance
     *
     * @param IUserRepository $userRepository
     */
    public function __construct(
        protected IUserRepository $userRepository,
    ){
    }

    /**
     * @param UserDto $dto
     * @return $this
     */
    public function setUserDto(UserDto $dto): static
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
        $this->userRepository->update(dto: $this->dto);
    }
}
