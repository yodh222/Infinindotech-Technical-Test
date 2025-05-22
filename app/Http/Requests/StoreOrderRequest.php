<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => ['required', 'exists:customers,id'],
            'product_id' => ['required', 'array', 'min:1'],
            'product_id.*' => ['distinct', 'exists:products,id'],
            'jumlah_dibeli' => ['required', 'array', 'min:1'],
            'jumlah_dibeli.*' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
