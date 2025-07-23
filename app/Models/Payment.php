<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'santri_id',
        'payment',
        'jumlah',
        'desc',
        'is_recurring',
        'date',
        'proof',
    ];

    public function santri(): BelongsTo
    {
        return $this->belongsTo(Santri::class);
    }

    protected $casts = [
        'is_recurring' => 'boolean',
        'date' => 'date',
        'jumlah' => 'decimal:2',
    ];
}
