<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryStructureComponentModel;
use App\SalaryStructureModel;
use App\SalaryComponentModel;
use App\DesignationModel;
use App\SalarySlipModel;
use App\DepartmentModel;
use App\EmployeModel;
use App\BranchModel;
use Validator;
use Redirect;
use Toastr;
use Carbon\Carbon;
use Input;

class SalarySlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['salary_structure'] = SalaryStructureModel::leftJoin('employe_basic_info','employe_basic_info.employe_basic_info_id','=','salary_structure.employee_basic_info_id')
                        ->leftJoin('branch','branch.branch_id', '=', 'salary_structure.branch_id')
                        ->leftJoin('department','department.department_id', '=', 'salary_structure.department_id')
                        ->leftJoin('designation','designation.designation_id', '=', 'salary_structure.designation_id')
                        ->select('employe_basic_info.employe_name','branch.branch_name','department.department_name','designation.designation_name','salary_structure.*')
                        ->get();
        return view('payroll.salary_slip',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $data['branch'] = BranchModel::get();
        $data['department'] = DepartmentModel::all();

        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new SalarySlipModel;
        $requested_data = $request->data;
        $requested_data['month'] = $request->month;
        $validate = Validator::make($requested_data, $data->validation());
        if ($validate->fails()) {
            return response()->json(
                [
                    'success'=>201,
                    'message'=>'Validation failed!'
                ]);
        }
        $salray_slip = SalarySlipModel::where('employee_basic_info_id', $requested_data['employee_basic_info_id'])
                                        ->where('month', $request->month)
                                        ->first();
        if ($salray_slip) {
            return response()->json(
            [
                'success'=>201,
                'message'=>'Salary Already Paid!'
            ]);
        }

        $data->fill($requested_data)->save();

        return response()->json(
            [
                'success'=>200,
                'message'=>'Salary Successfully Paid!'
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(DesignationModel::where('department_name',$id)->get());

        $data['salary_component'] = SalaryComponentModel::leftJoin('salary_structure_component','salary_structure_component.salary_component_id','=','salary_component.id')->where('salary_structure_component.salary_structure_id',$id)->select('salary_structure_component.*','salary_component.*','salary_component.id as component_id')->get();

        // dd($data['salary_component']);

        $data['branch'] = BranchModel::get();
        $data['department'] = DepartmentModel::all();
        $data['designation'] = DesignationModel::get();
        $data['salary_structure_component'] = SalaryStructureComponentModel::where('salary_structure_id',$id)->get();

        $data['salary_structure_data'] = SalaryStructureModel::leftJoin('employe_basic_info','employe_basic_info.employe_basic_info_id','=','salary_structure.employee_basic_info_id')
                        ->leftJoin('branch','branch.branch_id', '=', 'salary_structure.branch_id')
                        ->leftJoin('department','department.department_id', '=', 'salary_structure.department_id')
                        ->leftJoin('designation','designation.designation_id', '=', 'salary_structure.designation_id')
                        ->select('employe_basic_info.employe_name','branch.branch_name','department.department_name','designation.designation_name','salary_structure.*')
                        ->where('salary_structure.id',$id)
                        ->first();

        return view('payroll.salary_slip_pay',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get salaru slip data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function GetSalarySlipData(Request $request){
        $requested_data = $request->data;
        $date = \Carbon\Carbon::parse($requested_data['month'])->format('F-Y');

        $employee = SalaryStructureModel::get();
        $employee_id =$employee->pluck('employee_basic_info_id')->unique()->toArray();
        $data = EmployeModel::where(function($query) use($requested_data) {
            if ($requested_data['branch_id']) {
                $query->where('employe_basic_info.branch_name', $requested_data['branch_id']);
            }
            if ($requested_data['department_id']) {
                $query->where('employe_basic_info.department_name', $requested_data['department_id']);
            }
            if ($requested_data['designation_id']) {
                $query->where('employe_basic_info.designation_name', $requested_data['designation_id']);
            }
            // if ($requested_data['month']) {
            //     $query->where('salary_slip.month',$requested_data['month']);
            // }
        })->leftJoin('salary_structure','salary_structure.employee_basic_info_id','=','employe_basic_info.employe_basic_info_id')
          ->leftJoin('branch','branch.branch_id', '=', 'employe_basic_info.branch_name')
          ->leftJoin('department','department.department_id', '=', 'employe_basic_info.department_name')
          ->leftJoin('designation','designation.designation_id', '=', 'employe_basic_info.designation_name')
          ->select('employe_basic_info.employe_name',
                    'branch.branch_name as branchname',
                    'department.department_name as departmentname', 
                    'designation.designation_name as designationname', 
                    'employe_basic_info.*', 
                    'salary_structure.*','salary_structure.id as salary_structure_id')->whereIn('employe_basic_info.employe_basic_info_id',$employee_id)
                                    ->get();
        $fetch_data = array();
        $salary_slip = SalarySlipModel::where('month', $requested_data['month'])->get()->toArray();
        foreach ($data as $key => $value) {
            $fetch_data[$key] = $value;
            $salary_slip_data = collect($salary_slip)->where('employee_basic_info_id', $value->employe_basic_info_id);
            
            if (count($salary_slip_data) != 0) {
                $fetch_data[$key]['payment_status'] = 'Paid';
                $fetch_data[$key]['month_name'] = $date;
            }
            else{
                $fetch_data[$key]['payment_status'] = 'Unpaid';
                $fetch_data[$key]['month_name'] = $date;
            }
        }

        return response()->json($fetch_data);
    }


    public function SalaryBulkPayment(Request $request){
        $employee = SalaryStructureModel::get();
        $requested_data = $request->data;
        $employee_id =$employee->pluck('employee_basic_info_id')->unique()->toArray();
        $data = EmployeModel::where(function($query) use($requested_data) {
            if ($requested_data['branch_id']) {
                $query->where('employe_basic_info.branch_name', $requested_data['branch_id']);
            }
            if ($requested_data['department_id']) {
                $query->where('employe_basic_info.department_name', $requested_data['department_id']);
            }
            if ($requested_data['designation_id']) {
                $query->where('employe_basic_info.designation_name', $requested_data['designation_id']);
            }
        })->leftJoin('salary_structure','salary_structure.employee_basic_info_id','=','employe_basic_info.employe_basic_info_id')
          ->select('employe_basic_info.employe_name',
                    'employe_basic_info.*', 
                    'salary_structure.*','salary_structure.id as salary_structure_id')
          ->whereIn('employe_basic_info.employe_basic_info_id',$employee_id)
          ->get();

        $salary_slip = SalarySlipModel::where('month', $requested_data['month'])->get()->toArray();
        $slip_data_array = array();

        foreach ($data as $key => $value) {
            $salary_slip_data = collect($salary_slip)->where('employee_basic_info_id', $value->employe_basic_info_id);
            
            if (count($salary_slip_data) == 0) {
                $slip_data_array[$key]['employee_basic_info_id'] = $value->employee_basic_info_id;
                $slip_data_array[$key]['salary_structure_id'] = $value->salary_structure_id;
                $slip_data_array[$key]['amount'] = $value->amount;
                $slip_data_array[$key]['month'] = $requested_data['month'];
            }
        }
        SalarySlipModel::insert($slip_data_array);
    }
}
