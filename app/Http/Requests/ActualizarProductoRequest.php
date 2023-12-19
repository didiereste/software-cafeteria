<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ActualizarProductoRequest extends FormRequest
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
        $id = $this->route('producto');
        
        return [
            'nombre_producto' => [
                'required',
                'alpha',
                'string',
                'max:255',
                Rule::unique('productos', 'nombre_producto')->ignore($id),
            ],
            'referencia' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'categoria' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
        ];
    }
}
