<?php

declare(strict_types=1);

namespace Module\Card\Rules;

use Exception;
use Module\Card\Actions\GetCardByIdAction;

class ValidateIfExpensesExists
{
    public function __construct(
        public int $id,
    ){
    }

    /**
     * @return void
     * @throws Exception
     */
    public function validate(): void
    {
        $card = app(GetCardByIdAction::class)
            ->setId(id: $this->id)
            ->execute();

        if($card->expenses()->count() > 0){
            throw new Exception('It is not permitted to change card details with open expenses');
        }
    }
}
