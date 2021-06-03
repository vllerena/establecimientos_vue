<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function establecimientos()
    {
        return $this->hasMany(Establecimiento::class);
    }
}
