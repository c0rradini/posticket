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
}
