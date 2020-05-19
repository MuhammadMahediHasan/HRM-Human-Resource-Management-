<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveTypeModel extends Model
{
    protected $table='leave_type';
    protected $primaryKey='leave_type_id';
    protected $fillable=['leave_type_name','leave_type_description','leave_type_status'];

    public function validation()
    {
        return [
            "leave_type_name"=>'required',
            "leave_type_description"=>'required',
            "leave_type_status"=>'required',
        ];
    }
}
