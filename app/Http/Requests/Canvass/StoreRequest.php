<?php

namespace App\Http\Requests\Canvass;

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
            "project_name" => ["required"],
            "first_supplier" => ["required", "different:second_supplier", "different:third_supplier"],
            "second_supplier" => ["required", "different:first_supplier", "different:third_supplier"],
            "third_supplier" => ["required", "different:second_supplier", "different:first_supplier"],
            "radios5" => ["required"],
            "items.*" => ['required'],
            "items" => ['required', 'array'],
            "units.*" => ['required'],
            "units" => ['required', 'array'],
            "qtys.*" => ['required'],
            "qtys" => ['required', 'array'],
            "f_suppliers.*" => ['nullable'],
            "f_suppliers" => ['nullable', 'array'],
            "s_suppliers" => ['nullable', 'array'],
            "s_suppliers.*" => ['nullable'],
            "t_suppliers" => ['nullable', 'array'],
            "t_suppliers.*" => ['nullable'],
        ];
    }
}
