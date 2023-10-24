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
        "tReceived",
        "tPayload",
        "lat",
        "long",
        "alt",
        "sog",
        "cog",
        "arus",
        "tengangan",
        "daya",
        "klasifikasi",
        "ax",
        "ay",
        "az",
        "gx",
        "gy",
        "gz",
        "mx",
        "my",
        "mz",
        "roll",
        "pitch",
        "yaw",
        "suhu",
        "humidity"
    ];
}
