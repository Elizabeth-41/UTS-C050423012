<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Tambahkan ini
use Illuminate\Support\Str;

class WorkshopBenefit extends Model
{
    use HasFactory, SoftDeletes; // Gunakan SoftDeletes dengan kapital 'S'

    protected $fillable = [
        'name',
        'slug',
        'workshop_id',
        'tagline', // Tambahkan tagline ke fillable
        'updated_at',
        'created_at',
    ];
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}