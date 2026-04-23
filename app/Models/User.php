<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'User_Id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    public const CREATED_AT = 'CreatedAt';
    public const UPDATED_AT = null;

    protected $fillable = ['Name', 'Email', 'PasswordHash', 'Role_Id'];
    protected $hidden = ['PasswordHash'];

    public function getAuthPassword(): string
    {
        return $this->PasswordHash;
    }
}
