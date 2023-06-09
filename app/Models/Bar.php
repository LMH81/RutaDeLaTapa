<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'address', 'phone', 'opening_hours'];


    //Relación muchos a muchos
  
    public function tapas()
    {
         return $this->belongsToMany('App\Models\Tapa', 'bar_tapa')->withTimestamps();
                        
    }

    


   // Reglas de validación para el modelo Bar
   public static function rules()
   {
       return [
           'name' => 'required|string|max:100',
           'description' => 'required|string|max:2000',
           'address' => 'required|string|max:100',
           'phone' => 'required|string|max:20',
           'opening_hours' => 'required|string|max:100'
       ];
   }
}