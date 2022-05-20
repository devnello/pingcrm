<?php

namespace App\Models;

use App\Utils\Helper;
use App\Utils\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parrafo;
use App\Models\Documento;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

use App\Utils\Tab;

class Capitulo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = Tab::PTO_CAPITULOS;


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

    static function getCapitulo($document_id, $capitulo_id)
    {
        return Helper::SelView(View::V_PTO_CAPITULOS_00, '*', [
            ['documento_id', '=', $document_id], ['capitulo_id', '=', $capitulo_id]
        ]);
    }


}
