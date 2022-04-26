<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public $table = 'userslist';

    protected $fillable = [
        'first_name',
        'family_name',
        'email',
        'user_name',
        'dob',
        'gender',
        'password',
        'user_number',
        'status'
    ];
}
