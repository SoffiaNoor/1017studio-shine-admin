<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquireReservation extends Model
{
    use HasFactory;
    protected $table = 'enquire_reservation';

    protected $fillable = [
        'title',
        'description',
    ];
}
