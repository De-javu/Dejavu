<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEntitiesRequest extends FormRequest
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
        // Temporalmente simplificar las reglas para debug
        return [
            'name' => 'required|string|max:255', // ← Quitar |unique:entities,name temporalmente
            'entity' => 'required|string', // ← Cambiar de |in:public,private a |string
            'administrative_unit' => 'required|string', // ← Simplificar
            'producer_office' => 'required|string', // ← Simplificar
        ];
    }

    // Agregar método para debug
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd('❌ VALIDACIÓN FALLÓ:', $validator->errors()->toArray(), 'Datos recibidos:', $this->all());
    }

    
}
