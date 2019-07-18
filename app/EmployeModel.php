<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeModel extends Model
{
    protected $table='employe_basic_info';
    protected $primaryKey='employe_basic_info_id';
    protected $fillable=['employe_code','employe_name','branch_name','department_name','designation_name','father_name','mother_name','date_of_birth','national_id','nationality','employe_gender','blood_group','religion','merital_statas','employe_photo',];


    public function validation()
    {
    	return [
    		"employe_code"=>'required',
    		"employe_name"=>'required',
    		"branch_name"=>'required',
    		"department_name"=>'required',
    		"designation_name"=>'required',
    		"father_name"=>'required',
    		"mother_name"=>'required',
    		"date_of_birth"=>'required',
    		"national_id"=>'required',
    		"nationality"=>'required',
            "employe_gender"=>'required',
    		"blood_group"=>'required',
    		"religion"=>'required',
    		"merital_statas"=>'required',
    		"employe_photo"=>'required',
    	];
    }
}
