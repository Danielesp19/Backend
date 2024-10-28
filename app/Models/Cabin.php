<?php

namespace App\Models;

use App\Models\CabinLevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cabin extends Model
{
    use HasFactory;
    protected $table= 'cabins';
    protected $fillable = ['name', 'capacity', 'cabinlevel_id'];

    public function CabinLevel(): BelongsTo
    {
        return $this->belongsTo(CabinLevel::class), 'cabinlevel_id';
    }
}
