<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = ['secret_id', 'ip_address', 'reason'];
    
    public function secret(): BelongsTo
    {
        return $this->belongsTo(Secret::class);
    }
}
