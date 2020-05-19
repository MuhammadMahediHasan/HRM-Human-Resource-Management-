<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalarySlipModel extends Model
{
    protected $table = 'salary_slip';
    protected $primaryKey = 'id';
    protected $fillable = ['employee_basic_info_id','salary_structure_id','amount','month'];


    public function validation(){
    	return [
    		'employee_basic_info_id' => 'required',
    		'salary_structure_id' => 'required',
    		'amount' => 'required',
    		'month' => 'required',
    	];
    }
}
