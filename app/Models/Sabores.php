<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sabores extends Model
{
    use HasFactory;

    protected $fillable = ['nome','descricao','imagem','sorvete_id']; //erro ao dar "post" se nao tiver esse codigo

    public function sorvete(){
        return $this->belongsTo(Sorvete::class);
    }
}
