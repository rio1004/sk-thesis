<?php

namespace App\Http\Requests\Abc;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'proc_title' => ['required'],
            'bidder' => ['required'],
            'prepared_by' => ['required'],
            'approved_by' => ['required'],
            'recommended_by' => ['required'],
            'items' => ['required', 'array'],
            'units' => ['required', 'array'],
            'qtys' => ['required', 'array'],
            'prices' => ['nullable', 'array'],
            'taxes' => ['nullable', 'array'],
            'insurances' => ['nullable', 'array'],
            'indirects_costs' => ['nullable', 'array'],
            'adjustments' => ['nullable', 'array'],
        ];
    }
}
