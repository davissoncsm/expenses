<?php

namespace Module\User\Validation;

use Illuminate\Foundation\Http\FormRequest;

class UserValidation extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
     * @return array
     */
    public function storeRules(): array
    {
        return [
            'name' => 'required|string|max:45|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
            'is_admin' => 'sometimes|boolean',
        ];
    }

    /**
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'name' => 'required|string|max:45|unique:users,name,' . $this->id,
            'email' => 'required|string|email|unique:users,email,' . $this->id,
            'password' => 'required|string|min:6',
            'is_admin' => 'sometimes|boolean',
        ];
    }
}
