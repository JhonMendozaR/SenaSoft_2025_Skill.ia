<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoadmapHito extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'id_roadmap',
        'id_hito',
        'orden',
    ];

    public function idRoadmap()
    {
        return $this->belongsTo(Roadmap::class, 'id_roadmap');
    }

    public function idHito()
    {
        return $this->belongsTo(Hito::class, 'id_hito');
    }
}
