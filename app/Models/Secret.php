<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Secret extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'title',
        'summary',
        'category_id',
        'content',
        'lifecycle',
        'slug',
        'is_blocked',
        'is_editor_choice',
        'ip_address',
        'expires_at',
    ];
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function scopeActive($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
            ->orWhere('expires_at', '>', now());
        });
    }

    //relationship with  votes
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //related secrets to the one been currently viewed| with the same category_id with the one been currently viewed
    public function related($id)
    {
        
        $secets = Secret::where('category_id', $id)
        ->where('id', '!=', $this->id)
        ->where(function($query) {
            $query->whereNull('deleted_at');
        })
        ->where(function($query) {
            $query->whereNull('expires_at')
                ->orWhere('expires_at', '>', now());
        })
        ->orderByDesc('views')->orderBy("id")->get();
        return $secets;
    }

    //relationship with views
    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function prunable(): Builder
    {
        return static::where(function($query) {
            $query->where('expires_at', '<=', now())
                ->orWhere('is_blocked', true);
        });
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'secret_tag');
    }



}
