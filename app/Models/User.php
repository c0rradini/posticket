<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'ramal',
        'tecnico',
        'setores_id',
        'status',
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


    public function setor()
    {
        return $this->belongsTo(Setor::class, 'setores_id');
    }

    public function ticketsRequerente()
    {
        return $this->hasMany(Ticket::class, 'requerente_user_id');
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

    public function scopeSetores($query, $setores = null)
    {
        if (!is_null($setores)) {
            return $query->where('setores_id', $setores);
        }
    }




}
