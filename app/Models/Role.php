<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    // Define los atributos que se pueden asignar masivamente
  protected $fillable = ['name']; // Este es al atributoto registrado en la base de datos:

  public function user()// Este metodo define una relacion muchos a muchos con el modelo User
  {
    return $this->belongsToMany(User::class); //  Indica que ya podremos accerder a consultas de User.
  }

}
