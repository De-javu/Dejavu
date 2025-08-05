<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CrearSubSeries extends FormRequest
{
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

            'name' => 'required|string|max:255', // ← Quitar |unique:entities,name temporalmente
            'user_id' => 'nullable|integer|exists:users,id', // Asegurarse de que el usuario exista
            'parent_series_id' => 'required|integer|exists:documentary_series,id', // Asegurarse de que la entidad exista
             'entity_id' => 'required|integer|exists:entities,id',// ← Agrega esto

        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd('❌ VALIDACIÓN FALLÓ:', $validator->errors()->toArray(), 'Datos recibidos:', $this->all());
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre de la sub-serie es obligatorio.',
            'parent_series_id.required' => 'La serie padre es obligatoria.',
            'parent_series_id.exists' => 'La serie padre seleccionada no existe.',
            'entity_id.required' => 'La entidad es obligatoria.',
            'entity_id.exists' => 'La entidad seleccionada no existe.',
        ];
    }
}
