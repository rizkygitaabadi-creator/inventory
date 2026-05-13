<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'          => 'required|string|max:255',
            'quantity'      => 'required|integer|min:0',
            'price'         => 'required|numeric|min:0',
            'category_id'   => 'required|exists:categories,id',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Nama item wajib diisi.',
            'quantity.integer'     => 'Jumlah harus angka bulat.',
            'price.numeric'        => 'Harga harus berupa angka.',
            'categoty_id.exists'   => 'Kategori tidak ditemukan.',
        ];
    }
}
