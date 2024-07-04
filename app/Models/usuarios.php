<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class usuarios extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','contrasena'];
    

    public function entregas()
    {
        return $this->hasMany(entregas::class);
    }

    public function compras()
    {
        return $this->hasMany(compras::class);
    }

    public function cuentasTotales()
    {
        return $this->hasMany(cuentastotales::class);
    }
    
}
