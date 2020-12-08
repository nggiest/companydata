<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';

    public function company(){
        return $this->belongsTo(Company::class,'name');
    }
}
