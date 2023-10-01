<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tapa;
use App\Models\Bar;

class Bar_Tapa extends Model
{
    protected $table = 'bar_tapa';

    protected $fillable = [
        'bar_id',
        'tapa_id',
    ];

    public function tapas()
    {
        //return $this->belongsToMany(Tapa::class);
        return $this->belongsToMany(Tapa::class, 'bar_tapa', 'bar_id', 'tapa_id');
    }

    public function bars()
    {
        //return $this->belongsToMany(Bar::class);

        return $this->belongsToMany(Bar::class, 'bar_tapa', 'tapa_id', 'bar_id');
    }
}

