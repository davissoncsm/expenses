<?php

declare(strict_types=1);

namespace Module\User\Handlers\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Module\User\DTOs\Auth\LoginDto;
use Module\User\Response\LoginResponse;
use Module\User\Services\Auth\LoginService;
use Module\User\Validation\LoginValidation;

class LoginHandler
{
    /**
     * @param LoginValidation $validation
     * @return Application|ResponseFactory|\Illuminate\Foundation\Application|Response
     */
    public function __invoke(LoginValidation $validation)
    {
        $dto = LoginDto::makeFromValidation(validation: $validation);

        $service = (new LoginService())
                    ->setDto(dto: $dto)
                    ->execute();

        return response((new LoginResponse($service))->response(), 200);
    }
}
