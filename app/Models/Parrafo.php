<?php

namespace App\Models;

use App\Utils\T;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Capitulo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Parrafo extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = T::PTO_PARRAFOS;

    // MSP
    public function capitulo()
    {
        return $this->belongsTo(Capitulo::class);
    }

}
