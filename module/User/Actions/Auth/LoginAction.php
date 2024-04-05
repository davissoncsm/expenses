<?php
declare(strict_types=1);

namespace Module\User\Actions\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Module\User\Actions\Action;
use Module\User\DTOs\Auth\LoginDto;
use Module\User\Repositories\UserRepository;

class LoginAction extends  Action
{

    /**
     * @var LoginDto
     */
    private LoginDto $dto;

    /**
     * Class instance
     *
     * @param UserRepository $userRepository
     */
    public function __construct(
        protected UserRepository $userRepository,
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
