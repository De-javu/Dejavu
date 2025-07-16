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
    public function user() // Este metood define una realcio de uno a muchos con el modelo User
    {
        return $this->belongsTo(User::class); // Indica que ya podremos acceder a consultas de user.
    }

    public function documentarySeries() // Este metodo define una relacion de uno a muchos con el modelo query
    {
        return $this->hasMany(DocumentarySeries::class); // Indica que podremos acceder a conoltas de queries
    }

}



