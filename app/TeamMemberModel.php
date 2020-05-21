<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMemberModel extends Model
{
    protected $table = "team_member";
    protected $primaryKey = "id";
    protected $fillable = ['team_id','team_member_id'];
}
