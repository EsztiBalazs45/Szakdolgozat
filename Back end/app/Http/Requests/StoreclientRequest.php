<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreclientRequest extends FormRequest
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
            'companyName' => 'required|string|max:255',
            'tax_number' => 'required|digits:13',
            'registration_number' => 'required|digits:10',
            'headquarters' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'contact_number' => 'required|numeric|digits:15',
        ];
    }
}
