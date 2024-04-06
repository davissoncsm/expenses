<?php

declare(strict_types=1);

namespace Module\User\DTOs;

use Module\Abstracts\Dto;
use Module\User\Validation\LoginValidation;

class LoginDto extends Dto
{
    /**
     * @param string $email
     * @param string $password
     * @param string $deviceName
     */
    public function __construct(
        public string $email,
        public string $password,
        public string $deviceName,
    ){
    }

    /**
     * @param LoginValidation $validation
     * @return self
     */
   public static function makeFromValidation(LoginValidation $validation): self
   {
       $validate = $validation->validated();

       return new self(
           email: $validate['email'],
           password: $validate['password'],
           deviceName: $validate['device_name'],
       );
   }

    /**
     * @return array
     */
    public function toArray(): array
    {
        // TODO: Implement toArray() method.
    }
}
