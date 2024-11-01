<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'tagline',
    ];

    // Setter untuk 'name' dan otomatis mengisi 'slug'
    public function setNameAttribute($value)
    {
        // Perbaikan: Gunakan 'attributes' bukan 'attribute'
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function workshop(): HasMany
    {
        return $this->hasMany(Workshop::class);
    }
}
