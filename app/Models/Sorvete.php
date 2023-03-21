<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sorvete extends Model
{
    use HasFactory;

    protected $fillable = ['tipo']; //erro ao dar "post" se nao tiver esse codigo

    public function sabores(){
        return $this->hasMany(Sabores::class); //sorvete_id
    }
}
