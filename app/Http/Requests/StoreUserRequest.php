<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
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
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'user_status' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'user_status' => 'status',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'status_id' => $this->user_status,
        ]);
    }
}
