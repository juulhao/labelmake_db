<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rotule extends Model
{
    use HasFactory;

    protected $table = 'rotules';

    protected $fillable = [
        'nro_requisicao',
        'posologia',
        'formula',
    ];

    protected $casts = [
        'posologia' => 'array',
        'formula' => 'array'
    ];
}
