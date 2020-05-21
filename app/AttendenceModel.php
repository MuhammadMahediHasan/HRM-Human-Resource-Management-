<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendenceModel extends Model
{
    protected $table='attendence';
    protected $primaryKey='attendence_id';
    protected $fillable=['date','user_id'];
}
