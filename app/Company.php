<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'email_address', 'website'];

    public function employees()
    {
        return $this->hasMany('App\Employee');
    }
}
