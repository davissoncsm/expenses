<?php

declare(strict_types=1);

namespace Module\Card\DTOs\expense;

use Module\Abstracts\Dto;
use Module\Card\Validation\expense\ExpenseValidation;

class ExpenseDto extends Dto
{
    /**
     * @param int $value
     * @param int|null $cardId
     */
    public function __construct(
        public int $value,
        public ?int $cardId = null,
    ){
    }

    /**
     * @param ExpenseValidation $validation
     * @return self
     */
   public static function makeFromValidation(ExpenseValidation $validation): self
   {
       $validate = $validation->validated();

       return new self(
          value: $validate['value'],
          cardId: $validate['card_id'] ?? null,
       );
   }

    /**
     * @return array
     */
   public function create(): array
   {
       return [
           'card_id' => $this->cardId,
           'value' => $this->value,
       ];
   }

    /**
     * @return array
     */
    public function update(): array
    {
        return [
            'value' => $this->value,
        ];
    }
}
