<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveModel extends Model
{
    protected $table='leave';
    protected $primaryKey='leave_id';
    protected $fillable=['employe_code','leave_type_name','leave_from','leave_to','leave_reason','leave_status'];

    public function validation()
    {
    	return [
    		"employe_code"=>'required',
    		"leave_type_name"=>'required',
            "leave_from"=>'required',
            "leave_to"=>'required',
            "leave_reason"=>'required',
            "leave_status"=>'required',
    	];
    }
}
