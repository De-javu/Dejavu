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

     public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function entity()
    {
        return $this->belongsTo(Entities::class);
    }

     public function parentSeries()
    {
        return $this->belongsTo(DocumentarySeries::class, 'parent_series_id');
    }

    public function children()
    {
        return $this->hasMany(DocumentarySeries::class,'parent_series_id ');
    }
}


