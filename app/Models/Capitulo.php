<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parrafo;
use App\Models\Documento;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Capitulo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'pto_capitulos';


    protected $fillable = [
        'orden',
        'descripcion',
        'imagen',
    ];

    // MSP
    public function documento()
    {
        return $this->belongsTo(Documento::class);
    }

    public function parrafos()
    {
        return $this->hasMany(Parrafo::class);
    }


}
