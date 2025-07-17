<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'action',
        'description'

    ];
     public function user() // Indica que los logs pertenecen a un usuario, es una relación de uno a muchos
   {
        return $this->belongsTo(User::class); // Indica que ya podremos acceder a consultas de user.
    }
}




