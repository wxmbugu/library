<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property int    $email_verified_at
 * @property int    $created_at
 * @property int    $updated_at
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at'
    ];

    protected $hidden = [
        'password', 'email_verified_at', 'remember_token', 'updated_at'
    ];

    protected $casts = [
        'name' => 'string', 'email' => 'string', 'email_verified_at' => 'timestamp', 'password' => 'string', 'remember_token' => 'string', 'created_at' => 'timestamp', 'updated_at' => 'timestamp'
    ];

    protected $dates = [
        'email_verified_at', 'created_at', 'updated_at'
    ];

    public $timestamps = true;
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
