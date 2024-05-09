<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
        $rules = [
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
        ];

        if (auth()->user()->hasRole('admin')) {
            $rules['assigned_to'] = 'required';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'assigned_to' => 'assign to',
            'description' => 'task description',
        ];
    }

    public function validated($key = null, $default = null)
    {
        $validated = parent::validated($key, $default);

        return array_merge($validated, [
            'status_id' => $this->status,
            'priority_id' => $this->priority,
        ]);
    }
}
