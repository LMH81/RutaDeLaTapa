<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapa extends Model
{
    use HasFactory;

    

    //Relación muchos a muchos
       
    public function bars()
    {
        return $this->belongsToMany(Bar::class, 'bar_tapa');
    }
    
}
