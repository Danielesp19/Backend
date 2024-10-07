<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinService extends Model
{
    use HasFactory;

     protected $table= 'cabinservice';

    protected $fillable =[
        'cabin_id',
        'service_id'
    ];
}
