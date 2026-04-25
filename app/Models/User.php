<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role_id'];
    protected $hidden = ['password', 'remember_token'];

    public function getAuthPassword(): string
    {
        return $this->password;
    }
}
