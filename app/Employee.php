<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'surname', 'phone', 'email_address'];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }
}
