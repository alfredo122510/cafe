<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entregas extends Model
{
    use HasFactory;
 
    protected $fillable = ['usuario_id','producto_id','cantidad','entrega_fecha'];


    public function usuario()
    {
        return $this->belongsTo(usuarios::class);
    }

    public function producto()
    {
        return $this->belongsTo(productos::class);
    }

}

