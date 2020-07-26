<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'name' => 'required|string', 
            'descricao'=> 'required|string', 
            'age' => 'required|integer',
            'user_id' => 'required|numeric|exists:users,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo name é obrigatório',
            'descricao.required' => 'O campo descricao é obrigatório',
            'age.required' => 'O campo age é obrigatório'
        ];
    }
}
