<?php

declare(strict_types=1);

namespace Module\User\DTOs;

use Illuminate\Support\Facades\Hash;
use Module\Abstracts\Dto;
use Module\User\Validation\UserValidation;

class UserDto extends Dto
{
    /**
     * @param string $name
     * @param string $email
     * @param string $password
     * @param int|null $id
     * @param bool $isAdmin
     */
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?int $id = null,
        public bool $isAdmin = false,
    ){
    }

    /**
     * @param UserValidation $validation
     * @return self
     */
   public static function makeFromValidation(UserValidation $validation): self
   {
       $validate = $validation->validated();

       return new self(
          name: $validate['name'],
          email: $validate['email'],
          password: $validate['password'],
          id: $validation->id,
          isAdmin: $validate['is_admin'] ?? false,
       );
   }

    /**
     * @return array
     */
    public function create(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_admin' => $this->isAdmin,
        ];
    }

    /**
     * @return array
     */
    public function update(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_admin' => $this->isAdmin,
        ];
    }
}
