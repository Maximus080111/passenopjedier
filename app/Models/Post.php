<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'dog_name',
        'message',
        'start_date',
        'end_date',
        'price',
        'species',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
