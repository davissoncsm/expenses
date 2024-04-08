<?php

namespace Module\Card\Validation\expense;

use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ExpenseValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @throws Exception
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return match ($this->method()) {
            'POST' => $this->storeRules(),
            'PUT' => $this->updateRules(),
        };
    }

    /**
     * @return string[]
     */
    private function storeRules(): array
    {
        return [
            'card_id' => 'required|int',
            'value' => 'required|int|gt:0',
        ];
    }

    /**
     * @return string[]
     */
    private function updateRules(): array
    {
        return [
            'value' => 'required|int|gt:0',
        ];
    }
}
