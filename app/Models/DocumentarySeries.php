<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use League\CommonMark\Node\Block\Document;

class DocumentarySeries extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'parent_series_id',
        'entity_id'

    ];

     public function user() // Indica que una serie documental pertenece a un usuario, es una relación de uno a uno
    {
        return $this->belongsTo(User::class, 'user_id'); // Indica que ya podremos acceder a consultas de user.
    }

     public function entity()// Indica que una serie documental pertenece a una entidad, es una relación de uno a muchos
    {
        return $this->belongsTo(Entities::class, 'entity_id'); // Indica que ya podremos acceder a consultas de entity.
    }

     public function parentSeries()// Indica que una serie documental puede tener una serie documental padre, es una relación de uno a muchos
    {
        return $this->belongsTo(DocumentarySeries::class, 'parent_series_id'); // Indica que podremos acceder a consultas de series documentales padre
    }

    public function children() // Indica que una serie documental puede tener muchas series documentales hijas, es una relación de uno a muchos
    {
        return $this->hasMany(DocumentarySeries::class,'parent_series_id'); // Indica que podremos acceder a consultas de series documentales hijas
    }


         public function documentary_series()
     {
      return $this->hasMany(DocumentarySeries::class, 'parent_series_id');
    }



}


