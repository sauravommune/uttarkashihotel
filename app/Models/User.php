<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use  HasRoles, HasFactory, Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];
    protected $fillable = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'business_registration_date' => 'date',
        'bank_details' => 'array',
        'invoice_settings' => 'array',
        'payment_gateways' => 'array',
        'email_settings' => 'array'
    ];

    protected function panNumber(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value) => strtoupper($value),
            set: fn (mixed $value) => strtoupper($value),
        );
    }

    public function leads()
    {
        return $this->hasMany(Booking::class, 'referred_by', 'id');
    }
    
    public function payouts()
    {
        return $this->hasMany(Payout::class, 'user_id', 'id');
    }

}
