<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function statusBadge(): Attribute
    {
        return new Attribute(function () {
            $badge = '';
            if ($this->status) {
                $badge = '<span class="badge badge--success">' . trans('Active') . '</span>';
            } else {
                $badge = '<span class="badge badge--danger">' . trans('Banned') . '</span>';
            }
            return $badge;
        });
    }

}
