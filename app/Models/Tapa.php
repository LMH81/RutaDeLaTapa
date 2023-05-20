<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tapa extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'img', 'description', 'price'];
    

    //Relación muchos a muchos
       
    public function bars()
    {
        return $this->belongsToMany(Bar::class, 'bar_tapa');
    }
    
}
