<?php

declare(strict_types=1);

namespace Module\User\Handlers\Auth;

use Illuminate\Http\JsonResponse;
use Module\User\DTOs\LoginDto;
use Module\User\Presenters\LoginPresenter;
use Module\User\Services\Auth\LoginService;
use Module\User\Validation\LoginValidation;

class LoginHandler
{
    /**
     * @param LoginValidation $validation
     * @return JsonResponse
     */
    public function __invoke(LoginValidation $validation): JsonResponse
    {
        $dto = LoginDto::makeFromValidation(validation: $validation);

        $service = (new LoginService())
                    ->setDto(dto: $dto)
                    ->execute();

        return response()->json(LoginPresenter::make($service)->toArray(), 200);
    }
}
