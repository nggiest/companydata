<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = ['name_employee', 'email', 'id_company'];
    public function companies(){
        return $this->belongsTo(Company::class);
    }
}
