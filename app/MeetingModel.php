<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingModel extends Model
{
    protected $table = "meeting";
    protected $primaryKey = "meeting_id";
    protected $fillable = ['branch_id','department_id','designation_id','user_id','title','time','description'];


    public function validation() {
    	return [
    		'branch_id' => 'sometimes',
    		'department_id' => 'sometimes',
    		'designation_id' => 'sometimes',
    		'user_id' => 'sometimes',
    		'title' => 'required',
    		'time' => 'required',
    		'description' => 'required',
    	];
    }
}
