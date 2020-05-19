<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendenceParentModel extends Model
{
    protected $table='attendence_parent';
    protected $primaryKey='attendence_parent_id';
    protected $fillable=['attendence_parent_date','attendence_parent_department'];
}
