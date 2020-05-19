<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DesignationModel extends Model
{
    protected $table = "designation";
    protected $primaryKey = "designation_id";
    protected $fillable = ['department_name','designation_name','designation_status'];

    public function validation()
    {
    	return [
    		"department_name"=>'required',
    		"designation_name"=>'required',
    		"designation_status"=>'required',
    	];
    }
}
