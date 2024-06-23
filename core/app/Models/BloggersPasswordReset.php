<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OwnerPasswordReset extends Model
{
    protected $table = "blogger_password_resets";
    protected $guarded = ['id'];
    public $timestamps = false;
}
