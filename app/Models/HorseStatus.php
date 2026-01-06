<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HorseStatus extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function horses()
    {
        return $this->hasMany(Horse::class);
    }
}
