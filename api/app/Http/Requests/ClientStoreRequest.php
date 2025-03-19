<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email',
            'phone' => 'nullable|string|regex:/^\+?[0-9\s\-().]{8,20}$/',
            'mobile' => 'nullable|string|regex:/^\+?[0-9\s\-().]{8,20}$/',
            'address' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|regex:/^\d{5}-?\d{3}$/',
            'photo' => 'nullable|url|max:255',
            'birth_date' => 'nullable|date|before:today',
            'last_seen' => 'nullable|date',
            'status' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório.',
            'name.max' => 'O nome deve ter no máximo 255 caracteres.',
            'email.required' => 'O e-mail é obrigatório.',
            'email.email' => 'O e-mail precisa ser válido.',
            'email.unique' => 'Já existe um cliente cadastrado com este e-mail.',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres.',
            'phone.regex' => 'O telefone deve conter apenas números, espaços, hífens, parênteses ou sinais de "+" e ter entre 8 e 20 caracteres.',
            'mobile.regex' => 'O celular deve conter apenas números, espaços, hífens, parênteses ou sinais de "+" e ter entre 8 e 20 caracteres.',
            'address.max' => 'O endereço deve ter no máximo 255 caracteres.',
            'state.max' => 'O estado deve ter no máximo 100 caracteres.',
            'district.max' => 'O bairro deve ter no máximo 100 caracteres.',
        ];
    }
}
