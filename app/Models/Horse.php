<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    protected $fillable = [
        'stable_id',
        'name',
        'slug',
        'breed',
        'age',
        'notes',
        'letrot_url',
        'horse_status_id', // NEW
    ];

    public function stable()
    {
        return $this->belongsTo(Stable::class);
    }

    
    public function status()
    {
        return $this->belongsTo(HorseStatus::class, 'horse_status_id');
    }
}
