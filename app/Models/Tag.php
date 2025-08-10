<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
        'status',
    ];
    protected $casts = [
        'status' => 'string',
    ];
    public function secrets()
    {
        return $this->belongsToMany(Secret::class, 'secret_tag');
    }

}
