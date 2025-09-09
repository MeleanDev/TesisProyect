<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRegistradoRequest extends FormRequest
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
            'Pnombre' => ['required', 'string', 'min:2', 'max:100'],
            'Snombre' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:9048'],
            'Papelldio' => ['required', 'string', 'min:2', 'max:100'],
            'Sapelldio' => ['nullable', 'string', 'max:100'],
            'identidad' => [
                'required',
                'string',
                'min:2',
                'max:20',
            ],
            'telefono' => ['nullable', 'string', 'max:20'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'fecha_nacimiento' => ['required', 'date'],
        ];
    }
}
