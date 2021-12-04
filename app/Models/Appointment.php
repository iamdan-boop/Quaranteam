<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'contact_number',
        'date',
        'slots_allocated',
        'slots_booked',
        'dose',
        'reference_code',
        'active'
    ];



    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['reference_code']);
    }
}
