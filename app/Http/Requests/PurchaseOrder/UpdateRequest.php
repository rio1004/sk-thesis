<?php

namespace App\Http\Requests\PurchaseOrder;

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
            'po_no' => ['required'],
            'po_date' => ['required'],
            'mode_of_procurement' => ['nullable'],
            'place_of_delivery' => ['nullable'],
            'date_of_delivery' => ['nullable'],
            'delivery_term' => ['nullable'],
            'payment_term' => ['nullable'],
            'supplier_id' => ['required'],
            'poItemId' => ['nullable', 'array'],
            'poItemId.*' => ['nullable', 'exists:purchase_order_items,id'],
            'items' => ['nullable', 'array'],
            'units' => ['nullable', 'array'],
            'qtys' => ['nullable', 'array'],
            'unitCosts' => ['nullable', 'array'],
        ];
    }
}
