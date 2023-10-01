<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapa extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img', 'description', 'price'];
    

    //Relación muchos a muchos (Modelo con que se relaciona::class, 'nombre de la tabla intermedia', 'Llave foránea de la tabla en la que estamos ubicados', 'Llave foránea de la tabla a la que queremos acceder')
       
    public function bars()
{
    return $this->belongsToMany(Bar::class, 'bar_tapa', 'tapa_id', 'bar_id');
}

    
}

