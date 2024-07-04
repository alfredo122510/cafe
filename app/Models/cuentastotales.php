<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cuentastotales extends Model
{
    use HasFactory;
    protected $fillable = ['usuario_id','mes','ano','total_monto'];

    public function usuario()
    {
        return $this->belongsTo(usuarios::class);
    }
}
