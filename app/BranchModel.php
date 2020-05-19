<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BranchModel extends Model
{
    protected $table = "branch";
    protected $primaryKey = "branch_id";
    protected $fillable = ['branch_name','branch_status'];

    public function validation()
    {
    	return [
    		"branch_name"=>'required',
    		"branch_status"=>'required',
    	];
    }
}
