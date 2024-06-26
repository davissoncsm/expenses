<?php

declare(strict_types=1);

namespace Module\Card\DTOs\card;

use Module\Abstracts\Dto;
use Module\Card\Validation\card\CardValidation;

class CardDto extends Dto
{
    /**
     * @param string $number
     * @param int $limit
     * @param int|null $id
     * @param int|null $userId
     */
    public function __construct(
        public string $number,
        public int $limit,
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
           limit: (int)$validate['limit'],
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
