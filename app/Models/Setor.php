<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Setor extends Model
{
    use HasFactory;

    protected $table = 'setores';
    protected $fillable = [
        'name',
        'status',
    ];

    public function scopeAtivo($query)
    {
        $query->where('status',  1);
    }
}
