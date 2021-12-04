<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Announcement extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = [
        'title',
        'description',
        'date'
    ];

    protected $cast = [
        'date' => 'Y-m-d H:i'
    ];
}
