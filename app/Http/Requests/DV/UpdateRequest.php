<?php

namespace App\Http\Requests\DV;

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
            'dv_no' => ['required'],
            'dv_date' => ['required','date'],
            'payee_id' => ['required', 'exists:suppliers,id'],
            'check_no' => ['nullable'],
            'check_date' => ['nullable','date'],
            'bank_name' => ['nullable'],
            'bank_branch' => ['nullable'],
            'or_no' => ['nullable'],
            'or_date' => ['nullable','date'],
            'particularId' => ['required', 'array'],
            'particularId.*' => ['nullable', 'exists:disbursement_items,id'],
            'particular_text' => ['nullable'],
            'particular_item' => ['nullable', 'array'],
            'particular_amount' => ['nullable', 'array'],
            'skcc_no' => ['required'],
            'skcc_date' => ['required','date'],
            'to_name' => ['required'],
            'to_company' => ['required'],
            'to_address' => ['required'],
            'skccItemId' => ['required', 'array'],
            'skccItemId.*' => ['nullable', 'exists:skcc_items,id'],
            'acct_no' => ['nullable'],
            'acct_check_no' => ['nullable'],
            'acct_check_date' => ['nullable'],
            'payee' => ['nullable'],
            'amount' => ['nullable'],
            'purpose' => ['nullable'],
        ];
    }
}
