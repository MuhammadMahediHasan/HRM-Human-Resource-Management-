<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttendenceController;
use App\DepartmentModel;
use App\EmployeModel;
use App\ProjectModel;
use App\BranchModel;
use App\TeamModel;
use App\TaskModel;

class BackendController extends Controller
{
    public function DashboardData() {
    	$data['total_employees'] = EmployeModel::count();
    	$data['total_department'] = DepartmentModel::count();
    	$data['total_branch'] = BranchModel::count();
    	$data['total_team'] = TeamModel::count();

    	$data['total_project'] = ProjectModel::count();
    	$data['total_task'] = TaskModel::count();

    	$data['total_complete_project'] = ProjectModel::whereStatus(1)->count();
    	$data['total_complete_project_percent'] = ($data['total_project'] - $data['total_complete_project']) / $data['total_project'] * 100;

    	$data['total_ongoing_project'] = ProjectModel::whereStatus(0)->count();
    	$data['total_ongoing_project_percent'] = ($data['total_project'] - $data['total_ongoing_project']) / $data['total_project'] * 100;

    	$data['total_complete_task'] = TaskModel::whereStatus(1)->count();
    	$data['total_complete_task_percent'] = ($data['total_task'] - $data['total_complete_task']) / $data['total_task'] * 100;

    	$data['total_ongoing_task'] = TaskModel::whereStatus(0)->count();
    	$data['total_ongoing_task_percent'] = ($data['total_task'] - $data['total_ongoing_task']) / $data['total_task'] * 100;

    	return response()->json($data);
    }
}
