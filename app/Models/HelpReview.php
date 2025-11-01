<?php
// app/Models/HelpReview.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpReview extends Model
{
    protected $fillable = [
        'help_request_id', 'helper_id', 'helpee_id', 'rating', 'review'
    ];

    // Relationships
    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    public function helper()
    {
        return $this->belongsTo(User::class, 'helper_id');
    }

    public function helpee()
    {
        return $this->belongsTo(User::class, 'helpee_id');
    }
}