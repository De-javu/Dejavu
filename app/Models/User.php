<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Dom\Entity;
use GuzzleHttp\Psr7\Query;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function roles() // Indica que un usuario puede tener muchos roles, es una relación de muchos a muchos
    {
        return $this->belongsToMany(Role::class); // Indica que ya podremos acceder a consultas de roles.
    }

    public function queries() // Indica que un usuario puede tener muchas consultas, es una relación de uno a muchos
    {
        return $this->hasMany(Queries::class); // Indica que podremos acceder a consultas de Query
    }

    public function entity() //  Indica que el usuario solo puede tener una entidad, es una relación de uno a uno
        {
        return $this->hasOne(Entities::class); // Indica que el usuario solo puede tener una entidad
    }
     public function logs() // Indica que los usuarios pueden tener muchos logs, es una relación de uno a muchos
    {
        return $this->hasMany(Logs::class); // Indica que podremos acceder a conoltas de Logs
    }

      public function documentarySeries() // Indica que un usuario puede tener muchas series documentales, es una relación de uno a muchos
    {
        return $this->hasMany(DocumentarySeries::class); // Indica que podremos acceder a conoltas de Logs
    }


}

