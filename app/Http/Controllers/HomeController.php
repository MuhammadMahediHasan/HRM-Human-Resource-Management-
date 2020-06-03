<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthorizationException;
use App\SalarySlipModel;
use App\AttendenceModel;
use App\EmployeModel;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['present'] = AttendenceModel::whereDate('date',date('Y-m-d'))->count();
        
        $total_employees = EmployeModel::count();
        $data['absent'] = $total_employees - $data['present'];

        $data['paid'] = SalarySlipModel::where('month',date('Y-m'))->count();
        $data['unpaid'] = $total_employees - $data['paid'];

        return view('layouts.admin_dashboard',$data);
    }


    public function helper()
    {
        // $user = auth()->user();
        // echo $user;
        // abort_unless(Auth::user()->email == 'mahadihd727@gmail.com',404);
        // abort(404);

        // throw_if(Auth::user()->email == 'mahadih727@gmail.com',
        //     AuthorizationException::class,
        //     'You are not allowed to access this page'
        // );
    }
}
