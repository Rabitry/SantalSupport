<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_picture',
        'name',
        'sex',
        'occupation',
        'college_university',
        'subject_department',
        'blood_group',
        'phone',
        'email',
        'district',
        'upazila',
        'user_login_id',
    ];
}
