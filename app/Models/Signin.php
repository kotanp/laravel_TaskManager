<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Signin extends Authenticatable
{
    use HasFactory;
    protected $table = 'login';
    protected $primaryKey = 'azon';
    protected $keyType = 'string';
    public function user(){
        return $this->hasOne(User::class, 'id', 'userId');
    }
    // protected $casts = [
    //     'azon' => 'string'
    //   ];
}
