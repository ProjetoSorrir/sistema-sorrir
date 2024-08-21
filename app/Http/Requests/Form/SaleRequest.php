<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'price_per_number' => 'required|numeric|between:0,999999.99',
        ];
    }

    public function messages()
    {
        return [
            'price_per_number.required' => 'O preço por número é obrigatório.',
            'price_per_number.numeric' => 'O preço por número deve ser um valor numérico.',
            'price_per_number.between' => 'O preço por número deve estar entre 0 e 999999.99.',
        ];
    }
}
