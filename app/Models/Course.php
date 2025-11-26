<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'title',
        'slug',
        'description',
        'instructor',
    ];

    // Relación: un curso tiene muchas reseñas
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Para usar el slug en la URL en lugar del ID
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
