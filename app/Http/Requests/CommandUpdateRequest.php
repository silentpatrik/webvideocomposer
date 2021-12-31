<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommandUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'executable' => ['required', 'max:255', 'string'],
            'title' => ['nullable', 'max:255', 'string'],
            'parallel' => ['nullable', 'numeric'],
            'enabled' => ['nullable', 'boolean'],
        ];
    }
}
