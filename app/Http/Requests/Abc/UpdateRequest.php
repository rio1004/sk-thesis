<?php

namespace App\Http\Requests\Abc;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'procurement_title' => ['required'],
            'bidder' => ['required'],
            'submitted_by_id' => ['required', 'exists:officials,id'],
            'approved_by_id' => ['required', 'exists:officials,id'],
            'recommend_by_id' => ['required', 'exists:officials,id'],
            'abcId' => ['nullable', 'array'],
            'abcId.*' => ['nullable', 'exists:abc_items,id'],
            'items' => ['required', 'array'],
            'items.*' => ['required'],
            'units' => ['required', 'array'],
            'units.*' => ['required'],
            'qtys' => ['required', 'array'],
            'qtys.*' => ['required'],
            'prices' => ['nullable', 'array'],
            'prices.*' => ['required'],
            'taxes' => ['nullable', 'array'],
            'taxes.*' => ['required'],
            'insurances' => ['nullable', 'array'],
            'insurances.*' => ['required'],
            'indirects_costs' => ['nullable', 'array'],
            'indirects_costs.*' => ['required'],
            'adjustments' => ['nullable', 'array'],
            'adjustments.*' => ['required'],
        ];
    }
}
