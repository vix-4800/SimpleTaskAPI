<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Date;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    protected $dates = [
        'due_date',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function getDueDateAttribute($date)
    {
        return Date::createFromDate($date)->format('Y-m-d');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
