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
     public function user() // Este metodo define una realcio de uno a muchos con el modelo User
    {
        return $this->belongsTo(User::class); // Indica que ya podremos acceder a consultas de user.
    }
}




