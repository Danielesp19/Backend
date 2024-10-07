<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $table= 'reservations';

    protected $fillable =[
        'cabinservice_id',
        'user_id',
        'start_date',
        'end_date'
    ];
}
