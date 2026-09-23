<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class QrCode extends Model
{
    protected $fillable = [
        'name',
        'url',
        'slug',
    ];

    protected static function booted(): void
    {
        static::creating(function (QrCode $qrCode): void {
            $qrCode->slug ??= Str::lower(Str::random(12));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scans(): HasMany
    {
        return $this->hasMany(QrScan::class);
    }
}
