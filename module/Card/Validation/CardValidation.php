<?php

namespace Module\Card\Validation;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CardValidation extends FormRequest
{
    /**
     * @var int
     */
    public int $id;

    /**
     * Determine if the user is authorized to make this request.
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
        $this->id = (int)request()->route('id');

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
            'user_id' => 'required|int',
            'number' => 'required|string|unique:cards,number',
            'balance' => 'required|integer',
        ];
    }

    /**
     * @return string[]
     */
    private function updateRules(): array
    {
        return [
            'number' => 'required|string|unique:cards,number,' . $this->id,
            'balance' => 'required|integer',
        ];
    }
}
