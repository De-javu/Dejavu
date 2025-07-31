<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('entities')->where(function ($query) {
                    return $query->where('entity', $this->entity)
                               ->where('administrative_unit', $this->administrative_unit)
                               ->where('producer_office', $this->producer_office);
                }),
            ],
            'entity' => 'required|in:public,private,mixta',
            'administrative_unit' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-,\.]+$/' // Solo letras y espacios (nombres de dependencias)
            ],
            'producer_office' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\-,\.]+$/' // Solo letras y espacios
            ],
        ];

        // Si estamos editando, excluir el registro actual
        if ($this->route('entidade')) {
            $rules['name'][3] = $rules['name'][3]->ignore($this->route('entidade'));
        }

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
