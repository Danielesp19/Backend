<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CabinLevel extends Model
{
    use HasFactory;
    protected $table= 'cabin_levels';

    protected $fillable =[
        'name',
        'description'
    ];

    public function cabins(): HasMany
    {
        return $this ->hasMany(Cabin::class 'cabinlevel_id');
    }
}