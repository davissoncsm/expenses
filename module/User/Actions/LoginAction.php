<?php
declare(strict_types=1);

namespace Module\User\Actions;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Module\Abstracts\Action;
use Module\User\DTOs\LoginDto;
use Module\User\Repositories\Contracts\IUserRepository;

class LoginAction extends  Action
{

    /**
     * @var LoginDto
     */
    private LoginDto $dto;

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
     * @param LoginDto $dto
     * @return $this
     */
    public function setLoginDto(LoginDto $dto): static
    {
        $this->dto = $dto;
        return $this;
    }


    /**
     * @return string
     */
    public function execute(): string
    {
        $user = $this->userRepository->getUserByEmail(dto: $this->dto);

        if(!$user || !Hash::check($this->dto->password, $user['password'])) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user->tokens()->delete();

        return $user->createToken($this->dto->deviceName)->plainTextToken;
    }
}
