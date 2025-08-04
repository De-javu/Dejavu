<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearSerieDocumental extends FormRequest
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
            'user_id' => 'nullable|integer|exists:users,id', // Asegurarse de que el usuario exista
            'entity_id' => 'required|integer|exists:entities,id', // Asegurarse de que la entidad exista
        ];
    }

    // Agregar método para debug
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd('❌ VALIDACIÓN FALLÓ:', $validator->errors()->toArray(), 'Datos recibidos:', $this->all());
    }

}
