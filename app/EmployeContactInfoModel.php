<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeContactInfoModel extends Model
{
    protected $table='employe_contact_info';
    protected $primaryKey='employe_contact_info_id';
    protected $fillable=['employe_basic_info_id','phone_number','email','present_address','parmanent_address'];
}
