<?php

namespace App\Http\Requests\PurchaseRequest;

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
            'pr_no' => ['required'],
            'pr_date' => ['required'],
            'purpose' => ['required'],
            'requested_by_id' => ['required', 'exists:officials,id'],
            'items' => ['required', 'array'],
            'items.*' => ['required'],
            'units' => ['required', 'array'],
            'units.*' => ['required'],
            'qtys' => ['required', 'array'],
            'unitCosts' => ['required', 'array'],
            'unitCosts.*' => ['numeric'],
        ];
    }
}
