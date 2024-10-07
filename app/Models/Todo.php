<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Todo extends Model
{
    use HasFactory;

    // TODO hstak imanas incha a inchi hamara fillable@ +++
    protected $fillable = [
        'name',
        'type',
        'deadline_datetime',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTaskColorAttribute(): string
    {
        $available_days = $this->created_at->diffInDays($this->deadline_datetime);

        if ($available_days <= 1) {
            return 'red';
        } elseif ($available_days > 1 & $available_days <= 3) {
            return 'yellow';
        } else {
            return 'green';
        }
    }


    public function getAvailableDaysAttribute(): string
    {
        $available_days = $this->created_at->diffInDays($this->deadline_datetime);
        return $available_days . ' days left';
    }
}
