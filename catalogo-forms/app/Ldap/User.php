<?php

namespace App\Ldap;

use LdapRecord\Models\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;

class User extends Authenticatable implements LdapAuthenticatable
{
    use AuthenticatesWithLdap;

    protected $table = 'users';
    protected $primaryKey = 'guid';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [

    ];

    protected $hidden = [
        'guid'
    ];

    protected $casts = [
        
    ];

    /**
     * JWT - Functions
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
}
