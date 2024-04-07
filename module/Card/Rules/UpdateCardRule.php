<?php

namespace Module\Card\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Module\Card\Actions\GetCardByIdAction;

class UpdateCardRule implements ValidationRule
{
    public function __construct(
        public int $cardId,
    ){
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $card = app(GetCardByIdAction::class)
                ->setId(id: $this->cardId)
                ->execute();

        if($card->expenses()->count() > 0){
            $fail('It is not permitted to change card details with open expenses');
        }
    }
}
