<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Queries extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'file_id', 'description'];

    public function user() // Indica que las quieries pertenecen a un usuario, es una relación de uno a muchos
    {
        return $this->belongsTo(User::class); // Indica que ya podremos acceder a consultas de user.
    }


    public function uploadFile() // indica que una query pertenece a un archivo subido, es una relación de uno a uno
    {
        return $this->belongsTo(UploadFile::class); // Indica que ya podremos acceder a consultas de Uploadfile.
    }
}

