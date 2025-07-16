<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queries extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'file_id', 'description'];

    public function user() // Este metodp define una relacion de muchos a muchos con el modelo user
    {
        return $this->belongsTo(User::class); // Indica que ya podremos acceder a consultas de user.
    }


    public function uploadFile() // Este metodo define una relacion de muchos a muchos con el modelo uploadFile
    {
        return $this->belongsTo(UploadFile::class); // Indica que ya podremos acceder a consultas de Uploadfile.
    }
}

