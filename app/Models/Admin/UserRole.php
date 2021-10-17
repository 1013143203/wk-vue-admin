<?php

namespace App\Models\Admin;

class UserRole extends Base
{
    protected $table         = 'user_role';
    public $timestamps = false;
    protected $primaryKey    = 'id';
    protected $fillable = [
        'role_id', 'user_id'
    ];
}
