<?php

namespace App\Http\Requests;

use App\Http\Requests\FormRequest;

class UpdateNewModelRequest extends FormRequest
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
            'titre' => 'required|string|max:100',
            'contenu' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'date_debut' => 'nullable|date',
            'date_expiration' => 'nullable|date|after_or_equal:date_debut',
        ];
    }
}
