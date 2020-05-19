<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryStructureModel extends Model
{
    protected $table = "salary_structure";
    protected $primaryKey = "id";
    protected $fillable = ['employee_basic_info_id','branch_id','department_id','designation_id','amount','payroll_frequency','status'];

    public function validation()
    {
    	return [
    		"branch_id"=>'required',
    		"designation_id"=>'required',
    		"department_id"=>'required',
            "payroll_frequency"=>'required',
    	];
    }
}
