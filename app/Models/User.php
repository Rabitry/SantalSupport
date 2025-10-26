<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role',
    // ];
     protected $fillable = [
        'name', 
        'email', 
        'password', 
        'role',
        'student_id',
        'national_id',
        'id_card_front',
        'id_card_back',
        'status',
        'rejection_reason',
        'approved_at',
        'approved_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isApproved(){
        return $this->status === 'approved';
    }
    public function isPending(){
        return $this->status === 'pending';
    }
    public function isRejected(){
     return $this->status === 'rejected';
    }
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    // Check if user is regular user
    // public function isUser()
    // {
    //     return $this->role === 'user';
    // }
    public function population(){
        return $this->hasOne(Population::class, 'user_id');
    }
    // Get ID card front image URL
    public function getIdCardFrontUrl()
    {
        return $this->id_card_front ? asset('storage/' . $this->id_card_front) : null;
    }
    // Get ID card back image URL
    public function getIdCardBackUrl()
    {
        return $this->id_card_back ? asset('storage/' . $this->id_card_back) : null;
    }

}
