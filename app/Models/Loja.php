<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    protected $fillable = ['nomeLoja', 'endereco', 'telefone', 'imgLoja', 'rota'];

    use HasFactory;
}
