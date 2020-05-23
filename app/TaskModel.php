<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskModel extends Model
{
    protected $table = 'task';
    protected $primaryKey = 'task_id';
    protected $fillable = ['task_name','description','start_from','end_time','project_id','team_id','status'];

    public function validation(){
    	return [
    		'task_name'=>'required',
    		'description'=>'required',
    		'start_from'=>'required',
    		'end_time'=>'required',
    		'project_id'=>'required',
    		'team_id'=>'required',
    	];
    }

    public function team_member()
    {
        return $this->hasMany('App\TaskAssignModel','task_id');
    }
}
