<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeJoiningDetailsModel extends Model
{
    protected $table='employe_joining_info';
    protected $primaryKey='employe_joining_info_id';
    protected $fillable=['employe_basic_info_id','offer_date','confirmation_date','joining_date'];
}
