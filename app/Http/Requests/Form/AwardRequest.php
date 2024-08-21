<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class AwardRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'winner' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'winner.required' => 'O nome do Título é é obrigatório.',
        ];
    }
}