<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeTransferModel extends Model
{
    protected $table='employe_transfer';
    protected $primaryKey='employe_transfer_id';
    protected $fillable=['employe_basic_info_id','issue_date','previous_branch','previous_department','present_branch','present_department'];


    public function validation()
    {
    	return [
    		"employe_basic_info_id"=>'required',
    		"issue_date"=>'required',
    		"previous_branch"=>'required',
    		"previous_department"=>'required',
    		"present_branch"=>'required',
    		"present_department"=>'required',
    	];
    }
}
