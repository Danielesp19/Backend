<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinLevel extends Model
{
    use HasFactory;
    protected $table= 'cabin_leves';

    protected $fillable =[
        'name',
        'description'
    ];
}