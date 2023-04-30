<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'integer'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '項目名の入力は必須です',
            'price.required' => '金額の入力は必須です',
            'price.integer' => '金額は数値で入力してください',
        ];
    }
}
