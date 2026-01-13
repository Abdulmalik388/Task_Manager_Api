<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name','email','password'];

    protected $hidden = ['password','remember_token'];

    // Optional: automatically hash password
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
    public function tasks()
{
    return $this->hasMany(Task::class);
}

}
