<?php
// app/Models/HelpOffer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpOffer extends Model
{
    protected $fillable = [
        'help_request_id', 'user_id', 'message', 'status'
    ];

    // Relationships
    public function helpRequest()
    {
        return $this->belongsTo(HelpRequest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}