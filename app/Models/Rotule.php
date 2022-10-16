<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotule extends Model
{
    use HasFactory;

    protected $table = 'rotules';

    protected $fillable = [
        'nome',
        'cpf',
        'password',
        'tipo_usuario',
        'filial',
        'ativo',
    ];
}
