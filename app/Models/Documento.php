<?php

namespace App\Models;

use App\Utils\T;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;


class Documento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = T::PTO_DOCUMENTOS;

    /*
    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where($field ?? 'id', $value)->withTrashed()->firstOrFail();
    }
    */

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    // MSP
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // MSP Nuevo

    public function capitulos()
    {
        return $this->hasMany(Capitulo::class);
    }
}
