<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DepartmentModel;
use App\EmployeModel;
use App\BranchModel;
use App\TeamModel;

class BackendController extends Controller
{
    public function index()
    {
    	return view('layouts.admin_dashboard');
    }

    public function DashboardData() {
    	$data['total_employees'] = EmployeModel::count();
    	$data['total_department'] = DepartmentModel::count();
    	$data['total_branch'] = BranchModel::count();
    	$data['total_team'] = TeamModel::count();

    	return response()->json($data);
    }
}
