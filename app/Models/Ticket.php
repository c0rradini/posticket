<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\BaseModels;

class Ticket extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'tickets';

    protected $fillable = [
        'titulo',
        'requerente_user_id',
        'responsavel_user_id',
        'demanda',
        'ramal',
        'status',
        'setor_id',        
        'maquina_id',
    ];

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'maquina_id');
    }

    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setor_id');
    }

    public function requerente()
    {
        return $this->belongsTo(User::class, 'requerente_user_id');
    }

    public function responsavel()
    {
        return $this->belongsTo(User::class, 'responsavel_user_id');
    }
    
    public function logs()
    {
        return $this->hasMany(Log::class, 'ticket_id');
    }

    public function scopeStatus($query, $status = null)
    {
        if (!is_null($status)) {
            if ($status == 1) {
                $query->where('status',  1);
            } else {
                $query->where('status',  0);
            }
        }
    }

    public function scopeTecnico($query, $tecnico = null)
    {
        if (!is_null($tecnico)) {
            if ($tecnico == 1) {
                $query->where('tecnico',  1);
            } else {
                $query->where('tecnico',  0);
            }
        }
    }

    public function scopeMaquinas($query, $maquinas = null)
    {
        if (!is_null($maquinas)) {
            return $query->where('maquinas_id', $maquinas);
        }
    }

    public function scopeSetores($query, $setores = null)
    {
        if (!is_null($setores)) {
            return $query->where('setores_id', $setores);
        }
    }

    public function scopeRequerente($query, $requerentes = null)
    {
        if (!is_null($requerentes)) {
            return $query->where('requerentes_user_id', $requerentes);
        }
    }

    public function scopeResponsaveis($query, $responsaveis = null)
    {
        if (!is_null($responsaveis)) {
            return $query->where('responsaveis_user_id', $responsaveis);
        }
    }
}
