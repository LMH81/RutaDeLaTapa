<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bar_Tapa extends Model
{
    use HasFactory;   


    protected $table = 'bar_tapa';

    public function bars()
    {
        return $this->belongsToMany(Bar::class, 'bar_tapa', 'tapa_id', 'bar_id');
    }

    public function tapas()
    {
        return $this->belongsToMany(Tapa::class, 'bar_tapa', 'bar_id', 'tapa_id');
    }
}

