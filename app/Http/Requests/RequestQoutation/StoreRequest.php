<?php

namespace App\Http\Requests\RequestQoutation;

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
            "qoutation_no" => ['required'],
            "date" => ['required'],
            "procurement_ofcr_id" => ['required'],
            "supplier_id" => ['required'],
            "items.*" => ['required'],
            "items" => ['required','array'],
            "units.*" => ['required'],
            "units" => ['required', 'array'],
            "qtys.*" => ['required'],
            "qtys" => ['required', 'array'],
        ];
    }
}
