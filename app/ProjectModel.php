<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectModel extends Model
{
    protected $table = 'project';
    protected $primaryKey = 'project_id';
    protected $fillable = ['project_name','description','project_lead_team_id','status'];


    public function validation(){
    	return [
    		'project_name'=>'required',
    		'project_lead_team_id'=>'required',
    	];
    }
}
