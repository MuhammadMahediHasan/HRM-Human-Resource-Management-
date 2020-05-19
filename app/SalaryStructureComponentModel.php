<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryStructureComponentModel extends Model
{
    protected $table = "salary_structure_component";
    protected $primaryKey = "id";
    protected $fillable = ['salary_structure_id','salary_component_id','amount'];

    public function validation()
    {
    	return [
    		"salary_structure_id"=>'required',
    		"salary_component_id"=>'required',
    		"amount"=>'required',
    	];
    }
}
