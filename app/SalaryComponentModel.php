<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryComponentModel extends Model
{
    protected $table = "salary_component";
    protected $primaryKey = "id";
    protected $fillable = ['name','description','status'];

    public function validation()
    {
    	return [
    		"name"=>'required',
    		"description"=>'required',
    		"status"=>'required',
    	];
    }
}
