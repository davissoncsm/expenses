<?php

declare(strict_types=1);

namespace Module\Card\DTOs;

use Module\Abstracts\Dto;
use Module\Card\Validation\CardValidation;

class CardDto extends Dto
{
    /**
     * @param string $number
     * @param string $limit
     * @param int|null $id
     * @param int|null $userId
     */
    public function __construct(
        public string $number,
        public string $limit,
        public ?int $id = null,
        public ?int $userId = null,
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
           number: $validate['number'],
           limit: $validate['limit'],
           id: $validation->id,
           userId: $validate['user_id'] ?? null,
       );
   }

    /**
     * @return array
     */
   public function create(): array
   {
       return [
           'user_id' => $this->userId,
           'number' => $this->number,
           'limit' => $this->limit,
       ];
   }

    /**
     * @return array
     */
    public function update(): array
    {
        return [
            'number' => $this->number,
            'limit' => $this->limit,
        ];
    }
}
