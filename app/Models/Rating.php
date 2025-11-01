<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'population_id',
        'user_id',
        'rating',
        'feedback'
    ];

    public function population()
    {
        return $this->belongsTo(Population::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}