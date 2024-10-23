<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Owner extends Authenticatable
{
    use  Searchable;

    protected $guarded = ['id'];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address' => 'object',
        'ver_code_send_at' => 'datetime'
    ];
    protected $with = ['properties'];

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class)->where('status', '!=', 0);
    }

    public function login_logs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class)->orderBy('id', 'desc');
    }

    // SCOPES

    public function getFullnameAttribute()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function scopeActive()
    {
        return $this->where('status', 1);
    }

    public function scopeBanned()
    {
        return $this->where('status', 0);
    }

    public function scopeEmailUnverified()
    {
        return $this->where('ev', 0);
    }

    public function scopeSmsUnverified()
    {
        return $this->where('sv', 0);
    }

    public function scopeEmailVerified()
    {
        return $this->where('ev', 1);
    }

    public function scopeSmsVerified()
    {
        return $this->where('sv', 1);
    }

    public function reviews()
    {
        return $this->hasMany(Agent_review::class, 'agent_id');
    }

    public function scopeKycUnverified($query)
    {
        return $query->where('kv', 0);
    }

    public function scopeKycPending($query)
    {
        return $query->where('kv', 2);
    }

    public function properties()
    {
        return $this->hasMany(Property::class, 'owner_id', 'id')->where('status', 1);
    }

}
