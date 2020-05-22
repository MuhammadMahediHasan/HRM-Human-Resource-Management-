<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskAssignModel extends Model
{
    protected $table = "task_assign";
    protected $primaryKey = "task_assign_id";
    protected $fillable = ['task_id','task_assign_member_id','status'];
}
