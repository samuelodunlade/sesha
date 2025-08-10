<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'ip_address'
    ];
    //relationship with secret
    public function secret()
    {
        return $this->belongsTo(Secret::class);
    }

}
