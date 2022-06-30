<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductoMascota extends Model
{
    use HasFactory;

    public function categoria(){
        return $this->hasOne('App\Models\Categoria','id','idcategoria');

    }

    public function especie(){
        return $this->hasOne('App\Models\Especie','id','idespecie');
    }
}


