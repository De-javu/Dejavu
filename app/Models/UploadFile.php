<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UploadFile extends Model
{
     use HasFactory;
    protected $fillable = [
        'user_id',
        'documentary_series_id',
        'parent_series_id',
        'entity_id',
        'name',
        'path',
        'folio',
        'size',
        'start_date',
        'end_date',
        'hash_code'

    ];
     public function queries() // un usuario teien muchas consultas
    {

        return $this->hasMany(Queries::class, 'file_id'); // Indica que podremos acceder a conoltas de queries
    }

     public function user() // Este método define una relación de uno a muchos con el modelo User
    {
        return $this->belongsTo(User::class); // Indica que el archivo de carga pertenece a un usuario
    }

      public function documentarySerie() // Este método define una relación de uno a muchos con el modelo DocumentarySeries
    {
        return $this->belongsTo(DocumentarySeries::class); // Indica que el archivo de carga pertenece a una serie documental
    }
    public function parentSeries()
    {
        return $this->belongsTo(DocumentarySeries::class, 'parent_series_id');
    }

     public function Entity() // Este método define una relación de uno a muchos con el modelo Entities
    {
        return $this->belongsTo(Entities::class); // Indica que el archivo de carga pertenece a una entidad
    }
}




