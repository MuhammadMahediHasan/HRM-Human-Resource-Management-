<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DepartmentModel extends Model
{
    protected $table = "department";
    protected $primaryKey = "department_id";
    protected $fillable = ['department_name','department_status'];

    public function validation()
    {
    	return [
    		"department_name"=>'required',
    		"department_status"=>'required',
    	];
    }
}
