<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelemetriLog extends Model
{
    use HasFactory;

    /**
     * The attributes that guarded.
     *
     * @var array<string>
     */
    protected $guarded = ['id'];

    /**
     * Get the telemetriLog's tPayload.
     */
    protected function tPayload(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtotime($value),
        );
    }
}
