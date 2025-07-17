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
     public function queries() // Indica que un archivo de carga puede tener muchas consultas, es una relación de uno a muchos
    {

        return $this->hasMany(Queries::class, 'file_id'); // Indica que podremos acceder a consultas de Queries. como mabianos el id de la consulta le pasamos el id del archivo
    }

     public function user() // Indica que el archivo de carga pertenece a un usuario, es una relación de uno a muchos
    {
        return $this->belongsTo(User::class); // Indica que el archivo de carga pertenece a un usuario
    }

      public function documentarySerie() // Indica que el archivo de carga pertenece a una serie documental, es una relación de uno a muchos
    {
        return $this->belongsTo(DocumentarySeries::class); // Indica que el archivo de carga pertenece a una serie documental
    }
    public function parentSeries()// Indica que el archivo de carga pertenece a una serie documental padre, es una relación de uno a muchos
    {
        return $this->belongsTo(DocumentarySeries::class, 'parent_series_id'); // Indica que el archivo de carga pertenece a una serie documental padre
    }

     public function Entity() // Indica que el archivo de carga pertenece a una entidad, es una relación de uno a muchos
    {
        return $this->belongsTo(Entities::class); // Indica que el archivo de carga pertenece a una entidad
    }
}




