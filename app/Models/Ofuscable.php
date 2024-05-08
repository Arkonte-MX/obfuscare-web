<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ofuscable extends Model
{
    use HasFactory;

    protected $table = 'ofuscable';

    protected $fillable = [
        'valor',
        'id_severidad',
        'id_usuario',
        'id_alternativa'
    ];

    protected $hidden = [
        'id_usuario',
    ];
}
