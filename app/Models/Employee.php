<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'phone',
        'position_id',
    ];

    public function position(){
        return $this->belongsTo(Positions::class);
    }
}
