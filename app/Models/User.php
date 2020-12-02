<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public static function getAll()
    {
        return self::select('id','firstname','email','phone','role_id')->get();
    }
}
