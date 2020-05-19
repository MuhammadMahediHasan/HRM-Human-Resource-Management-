<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttendenceChildModel extends Model
{
    protected $table='attendence_child';
    protected $primaryKey='attendence_child_id';
    protected $fillable=['attendence_parent_id','id','attendence_child_status'];
}
