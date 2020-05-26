<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeetingEventModel extends Model
{
    protected $table = "meeting_event";
    protected $primaryKey = "meeting_event_id";
    protected $fillable = ['branch_id','department_id','designation_id','user_id','meeting_or_event','title','time','description'];


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
