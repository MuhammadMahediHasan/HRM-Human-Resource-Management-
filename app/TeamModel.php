<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamModel extends Model
{
    protected $table = "team";
    protected $primaryKey = "team_id";
    protected $fillable = ['team_name','team_leader_id','description'];

    public function validation()
    {
    	return [
    		"team_name"=>'required',
    		"team_leader_id"=>'required',
    		"description"=>'sometimes',
    	];
    }

    public function team_member()
    {
        return $this->hasMany('App\TeamMemberModel','team_id');
    }
}
