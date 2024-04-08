<?php

namespace Module\Card\Validation\card;

use Exception;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Module\Card\Rules\ValidateIfExpensesExists;

class CardValidation extends FormRequest
{
    /**
     * @var int
     */
    public int $id;

    /**
     * Determine if the user is authorized to make this request.
     * @throws Exception
     */
    public function authorize(): bool
    {
        $this->id = (int)request()->route('id');

        if($this->method() === 'PUT' || $this->method() === 'DELETE') {
            (new ValidateIfExpensesExists(id: $this->id))->validate();
        }
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
            'user_id' => 'required|int',
            'number' => 'required|numeric|digits_between:13,16|unique:cards,number',
            'limit' => 'required|integer',
        ];
    }

    /**
     * @return string[]
     */
    private function updateRules(): array
    {
        return [
            'number' => 'sometimes|numeric|digits_between:13,16|unique:cards,number,' . $this->id,
            'limit' => 'sometimes|integer',
        ];
    }
}
