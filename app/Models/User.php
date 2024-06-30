<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'roles',
        'role_id',
        'genders',
        'gender_id',
        'phone_number',
        'street',
        'house_number',
        'date_of_birth',
        'postal_code',
        'national_insurance_number'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }

    public function scopeSearchLastNameOrFirstName($query, $search = '%')
    {
        return $query->where('last_name', 'like', "%{$search}%")
            ->orWhere('first_name', 'like', "%{$search}%");
    }
    public function members()
    {
        return $this->hasMany(Member::class);
    }
    public function trainings()
    {
        return $this->hasMany(Training::class);
    }
    public function group_users()
    {
        return $this->hasMany(GroupUser::class);
    }
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    public function hourly_wages()
    {
        return $this->hasMany(HourlyWage::class);
    }
    public function user_attendances()
    {
        return $this->hasMany(UserAttendance::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class)->withDefault();
    }
    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }
    public function member_users()
    {
        return $this->hasMany(MemberUser::class);
    }
}
