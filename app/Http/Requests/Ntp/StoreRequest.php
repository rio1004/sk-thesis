<?php

namespace App\Http\Requests\Ntp;

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
            "ntp_date" => ['required'],
            "ntp_effectivity_date" => ["required"],
            "project_location" => ["required"],
            "canvass_id" => ["required"],
        ];
    }
}
