<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelemetriLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'latitude',
        'longitude',
        'SoG',
        'CoG',
        'current',
        'voltage',
        'power',
        'status',
        'ax',
        'ay',
        'az',
        'gx',
        'gy',
        'gz'
    ];
}
