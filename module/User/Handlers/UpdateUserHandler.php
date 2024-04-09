<?php

declare(strict_types=1);

namespace Module\User\Handlers;

use Exception;
use Illuminate\Http\JsonResponse;
use Module\User\DTOs\UserDto;
use Module\User\Services\UpdateUserService;
use Module\User\Validation\UserValidation;

class UpdateUserHandler
{
    /**
     * @param UserValidation $validation
     * @return JsonResponse
     * @throws Exception
     */
    public function __invoke(UserValidation $validation): JsonResponse
    {
        $dto = UserDto::makeFromValidation(validation: $validation);

        (new UpdateUserService())
                ->setDto(dto: $dto)
                ->execute();

        return response()->json([], 204);
    }
}
