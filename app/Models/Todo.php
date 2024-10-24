<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use function Laravel\Prompts\warning;

class Todo extends Model
{
    use HasFactory;

    // TODO hstak imanas incha a inchi hamara fillable@ +++
    protected $fillable = [
        'name',
        'type',
        'order',
        'deadline_datetime',
        'image',
        'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getTaskColorAttribute(): string
    {
        $available_days = now()->diffInDays($this->deadline_datetime);


        if ($this->deadline_datetime >= Carbon::now()) {
            if ($available_days <= 1) {
                return 'red';
            } elseif ($available_days <= 3) {
                return 'orange';
            } else {
                return 'green';
            }
        } else {
            return 'black';
        }
    }



    public function getAvailableDaysAttribute(): string
    {
        $available_days = now()->diffInDays($this->deadline_datetime);
        if ($this->deadline_datetime >= Carbon::now()) {
            if ($available_days == 0) {
                return 'today';
            } else {
                return $available_days . ' days left';
            }
        } else {
            return 'expired';
        }
    }
}
