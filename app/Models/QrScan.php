<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QrScan extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'scanned_at',
        'ip_hash',
        'user_agent',
        'referer',
    ];

    protected function casts(): array
    {
        return ['scanned_at' => 'datetime'];
    }

    public function qrCode(): BelongsTo
    {
        return $this->belongsTo(QrCode::class);
    }
}
