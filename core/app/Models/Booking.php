<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public function getCreatedAtAttribute($value)
{
    return Carbon::parse($value); // or however your dates are stored
}
}
