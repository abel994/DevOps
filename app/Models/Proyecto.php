<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'slug',
        'proyecto_id',
        'estatus_id'
    ];

    //relaciones
    public function estatus(){
        return $this->belongsTo(Estatus::class,'estatus_id');
    }
}
