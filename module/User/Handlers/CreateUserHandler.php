<?php

declare(strict_types=1);

namespace Module\User\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\User\DTOs\UserDto;
use Module\User\Presenters\CreateUserPresenter;
use Module\User\Services\CreateUserService;
use Module\User\Validation\UserValidation;

class CreateUserHandler
{
    /**
     * @param UserValidation $validation
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(UserValidation $validation): JsonResponse
    {
        $dto = UserDto::makeFromValidation(validation: $validation);

        (new CreateUserService())
                ->setDto(dto: $dto)
                ->execute();

        return response()->json(CreateUserPresenter::make()->toArray(), 201);
    }
}
