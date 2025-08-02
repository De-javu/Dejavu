<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateEntitiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool // Se encarga de determinar si el usuario está autorizado para realizar esta solicitud
    {
        return true;
    }

    /**
     *
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
public function rules(): array // Se encarga de definir las reglas de validación para la solicitud de creación de entidades
    {
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                 // NOTA: Laravel ya tiene todos los campos disponibles aquí y validados para pasara a la validacion compleja
                // $this->entity, $this->administrative_unit, etc. ya están definidos

                Rule::unique('entities')->where(function ($query) {
                    return $query->where('entity', $this->entity)
                               ->where('administrative_unit', $this->administrative_unit)
                               ->where('producer_office', $this->producer_office);

                })
                     // Se encarda de validar si, se edita una entidad existente, ignorando el ID actual
                                ->ignore($this->route('entidade')),


            ],

            // Validación del tipo de entidad
            'entity' => 'required|in:public,private,mixta',

            // Validación de la unidad administrativa y oficina productora
            'administrative_unit' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-,\.]+$/' // Solo letras y espacios (nombres de dependencias,-.)
            ],

            // Validación de la oficina productora
            'producer_office' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-,\.]+$/' // Solo letras y espacios
            ],
        ];

        return $rules;
    }

    public function messages(): array
    {
         // Operador ternario anidado para los TRES tipos
    $entityType = $this->entity == 'public' ? 'Pública' :
                  ($this->entity == 'private' ? 'Privada' : 'Mixta');
        return [

        // Mensaje personalizado con el tipo capturado
            'name.unique' => "⚠️ Ya existe una entidad con el nombre \"{$this->name}\" del tipo \"{$entityType}\" en la unidad \"{$this->administrative_unit}\" con oficina productora \"{$this->producer_office}\".",
            'name.required' => 'El nombre de la entidad es obligatorio.',
            'entity.required' => 'El tipo de entidad es obligatorio.',
            'administrative_unit.required' => 'La unidad administrativa es obligatoria.',
            'administrative_unit.regex' => 'La unidad administrativa solo puede contener letras y espacios.',
            'producer_office.required' => 'La oficina productora es obligatoria.',
            'producer_office.regex' => 'La oficina productora solo puede contener letras y espacios.',
        ];
    }

    // Agregar método para debug
    //protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    //{
        //dd('❌ VALIDACIÓN FALLÓ:', $validator->errors()->toArray(), 'Datos recibidos:', $this->all());
    //}


}
