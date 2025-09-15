<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Entities extends Model

{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'entity',
        'administrative_unit',
        'producer_office'

    ];
    public function user() // Indica que una entidad pertenece a un usuario, es una relación de uno uno
    {
        return $this->belongsTo(User::class); // Indica que ya podremos acceder a consultas de user.
    }

    public function documentarySeries() // Indica que una entidad puede tener muchas series documentales, es una relación de uno a muchos
    {
        return $this->hasMany(DocumentarySeries::class, 'entity_id'); // Indica que podremos acceder a conoltas de queries
    }

    public function uploadFiles() // Indica que una entidad puede tener muchos archivos de carga, es una relación de uno a muchos
    {
        return $this->hasMany(UploadFile::class, 'entity_id'); // Indica que podremos acceder a conoltas de queries
    }




}



