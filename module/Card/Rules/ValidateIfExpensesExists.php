<?php

declare(strict_types=1);

namespace Module\Card\Rules;

use Module\Card\Actions\GetCardByIdAction;
use Module\Card\Exceptions\ExistsExpensesException;

class ValidateIfExpensesExists
{
    public function __construct(
        public int $id,
    ){
    }

    /**
     * @return void
     * @throws ExistsExpensesException
     */
    public function validate(): void
    {
        $card = app(GetCardByIdAction::class)
            ->setId(id: $this->id)
            ->execute();

        if($card->expenses()->count() > 0){
            throw new ExistsExpensesException('It is not permitted to change card details with open expenses');
        }
    }
}
