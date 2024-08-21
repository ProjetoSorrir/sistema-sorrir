<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class GeneralInfoRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'draw_date' => 'required|date',
            'show_draw_date' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do Título é obrigatório.',
            'description.required' => 'O conteúdo da descrição/regulamento é obrigatório.',
            'draw_date.required' => 'A data do sorteio é obrigatória.',
            'draw_date.date' => 'O campo data do sorteio deve ser uma data válida.',
        ];
    }
}