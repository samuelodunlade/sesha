<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = ['secret_id', 'ip_address', 'type'];
    
    public function secret()
    {
        return $this->belongsTo(Secret::class);
    }

}
