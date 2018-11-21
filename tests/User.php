<?php

namespace Tests;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $guarded = [];

    public $timestamps = false;

    protected $table = 'users';
}
