<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
        'setor_id',
        'dataFechamento',
        'status',
        'maquina_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
