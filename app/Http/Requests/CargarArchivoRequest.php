<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargarArchivoRequest extends FormRequest
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
            'entidad_id' => 'required|exists:entities,id',
            'serie_id' => 'required|exists:documentary_series,id',
            'subserie_id' => 'required|exists:documentary_series,id',
            'name' => 'required|string|max:255',
            'folio' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'extension' => 'nullable|string|max:10',
            'mime_type' => 'nullable|string|max:50',
            'size' => 'nullable|integer',
            'archivo' => 'required|array',
            'archivo.*' => 'file|mimes:jpg,jpeg,pdf,tiff,tif,mp3,mp4|max:53248', // 52,248 KB = 51 MB

            // Validacion para complemento documental
            'trd_code' => 'nullable|string|max:20',
            'central_retention_years' => 'nullable|integer|min:0',
            'final_disposition' => 'nullable|string|max:50',
            'retention_notes' => 'nullable|string',


        ];
    }

     protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        dd('❌ VALIDACIÓN FALLÓ:', $validator->errors()->toArray(), 'Datos recibidos:', $this->all());
    }
}
