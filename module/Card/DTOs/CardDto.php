<?php

declare(strict_types=1);

namespace Module\Card\DTOs;

use Module\Abstracts\Dto;
use Module\Card\Validation\CardValidation;

class CardDto extends Dto
{
    /**
     * @param int $userId
     * @param string $number
     * @param string $balance
     */
    public function __construct(
        public int $userId,
        public string $number,
        public string $balance,
    ){
    }

    /**
     * @param CardValidation $validation
     * @return self
     */
   public static function makeFromValidation(CardValidation $validation): self
   {
       $validate = $validation->validated();

       return new self(
           userId: $validate['user_id'],
           number: $validate['number'],
           balance: $validate['balance'],
       );
   }

   public function create(): array
   {
       return [
           'user_id' => $this->userId,
           'number' => $this->number,
           'balance' => $this->balance,
       ];
   }
}
