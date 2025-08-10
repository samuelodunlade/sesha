<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //

    protected $fillable = [
        "title",
        "description",
        "cover_image",
        "icon",
        "slug",
        "status",
        "is_choice"
    ];

    //relationship with secrets


    //active and inactive button
    public function getStatusAttribute($value)
    {
        return $value == 'active' ? true : false;
    }

    //relationship with secrets
    public function secrets()
    {
        return $this->hasMany(Secret::class);
    }

    //active secrets
    public function activeSecrets()
    {
        return $this->hasMany(Secret::class)
                ->where('is_blocked', false)
                ->where('expires_at', '>', now());
    }
    

    //categories with at least one secret
    public function scopeWithSecrets($query)
    {
        return $query->whereHas('secrets');
    }

        /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    

}
