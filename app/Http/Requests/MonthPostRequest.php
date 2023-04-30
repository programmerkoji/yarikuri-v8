<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonthPostRequest extends FormRequest
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
            'year' => ['required', 'integer', 'digits:4'],
            'month' => ['required', 'integer', 'max:12'],
        ];
    }

    public function messages()
    {
        return [
            'year.required' => '年の入力は必須です',
            'month.required' => '月の入力は必須です',
            'year.integer' => '年は数値で入力してください',
            'month.integer' => '月は数値で入力してください',
            'year.digits' => '年は4桁で入力してください',
            'month.max' => '月は12以下で入力してください',
        ];
    }
}
