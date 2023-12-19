<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NuevoProductoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre_producto' => 'required|unique:productos,nombre_producto|alpha|string|max:255',
            'referencia' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ];
    }
}
