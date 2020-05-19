<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryStructureComponentModel;
use App\SalaryStructureModel;
use App\SalaryComponentModel;
use App\DesignationModel;
use App\DepartmentModel;
use App\EmployeModel;
use App\BranchModel;
use Validator;
use Redirect;
use Toastr;
use Input;

class SalaryStructureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['salary_structure'] = SalaryStructureModel::leftJoin('employe_basic_info','employe_basic_info.id','=','salary_structure.employee_basic_info_id')
                        ->leftJoin('branch','branch.branch_id', '=', 'salary_structure.branch_id')
                        ->leftJoin('department','department.department_id', '=', 'salary_structure.department_id')
                        ->leftJoin('designation','designation.designation_id', '=', 'salary_structure.designation_id')
                        ->select('employe_basic_info.employe_name','branch.branch_name','department.department_name','designation.designation_name','salary_structure.*')
                        ->get();
        return view('payroll.salary_structure_report',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['salary_component'] = SalaryComponentModel::get();
        $data['branch'] = BranchModel::get();
        $data['department'] = DepartmentModel::all();
        $data['designation'] = DesignationModel::get();
        return view('payroll.salary_structure',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = new SalaryStructureModel;
        $validate = Validator::make($request->all(), $data->validation());
        if ($validate->fails()) {
            if (array_sum($request->component) == 0) {
                Toastr::error('Fill the components!!', 'warning', ["positionClass" => "toast-top-right"]);
                return back()->withInput()->withErrors($validate);
            }
            else{
                return back()->withInput()->withErrors($validate);
            }
        }

        if (is_array($request->employee_basic_info_id) == false) {
            Toastr::error('Select Atleast one employee!!', 'warning', ["positionClass" => "toast-top-right"]);
            return back()->withInput()->withErrors($validate);
        }

        if (array_sum($request->component) == 0) {
            Toastr::error('Fill the components!!', 'warning', ["positionClass" => "toast-top-right"]);
            return back()->withInput()->withErrors($validate);
        }

        foreach ($request->employee_basic_info_id as $key => $employee_basic_info_id) {
            $salary_structure = new SalaryStructureModel;
            $salary_structure->employee_basic_info_id = $employee_basic_info_id;
            $salary_structure->branch_id = $request->branch_id;
            $salary_structure->department_id = $request->department_id;
            $salary_structure->designation_id = $request->designation_id;
            $salary_structure->payroll_frequency = $request->payroll_frequency;
            $salary_structure->amount = array_sum($request->component);
            $salary_structure->save();

            foreach ($request->component as $key => $value) {
                if ($value != 0 && $value != null) {
                    $salary_structure_component = new SalaryStructureComponentModel;
                    $salary_structure_component->salary_structure_id = $salary_structure->id;
                    $salary_structure_component->salary_component_id = $key;
                    $salary_structure_component->amount = $value;
                    $salary_structure_component->save();
                }
            }
        }

        Toastr::success('Salary Structure Added Successfully!!', 'success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['salary_component'] = SalaryComponentModel::leftJoin('salary_structure_component','salary_structure_component.salary_component_id','=','salary_component.id')->where('salary_structure_component.salary_structure_id',$id)->select('salary_structure_component.*','salary_component.*','salary_component.id as component_id')->get();

        // dd($data['salary_component']);

        $data['branch'] = BranchModel::get();
        $data['department'] = DepartmentModel::all();
        $data['designation'] = DesignationModel::get();
        $data['salary_structure_component'] = SalaryStructureComponentModel::where('salary_structure_id',$id)->get();

        $data['salary_structure_data'] = SalaryStructureModel::leftJoin('employe_basic_info','employe_basic_info.id','=','salary_structure.employee_basic_info_id')
                        ->leftJoin('branch','branch.branch_id', '=', 'salary_structure.branch_id')
                        ->leftJoin('department','department.department_id', '=', 'salary_structure.department_id')
                        ->leftJoin('designation','designation.designation_id', '=', 'salary_structure.designation_id')
                        ->select('employe_basic_info.employe_name','branch.branch_name','department.department_name','designation.designation_name','salary_structure.*')
                        ->where('salary_structure.id',$id)
                        ->first();

        return view('payroll.salary_structure_edit',$data);
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
        // dd($request->all());
        $data = new SalaryStructureModel;
        $validate = Validator::make($request->all(), $data->validation());
        if ($validate->fails()) {
            if (array_sum($request->component) == 0) {
                Toastr::error('Fill the components!!', 'warning', ["positionClass" => "toast-top-right"]);
                return back()->withInput()->withErrors($validate);
            }
            else{
                return back()->withInput()->withErrors($validate);
            }
        }

        if (!$request->employee_basic_info_id) {
            Toastr::error('Select Atleast one employee!!', 'warning', ["positionClass" => "toast-top-right"]);
            return back()->withInput()->withErrors($validate);
        }

        if (array_sum($request->component) == 0) {
            Toastr::error('Fill the components!!', 'warning', ["positionClass" => "toast-top-right"]);
            return back()->withInput()->withErrors($validate);
        }

        $salary_structure = SalaryStructureModel::findOrFail($id);
        $salary_structure->payroll_frequency = $request->payroll_frequency;
        $salary_structure->amount = array_sum($request->component);
        $salary_structure->save();

        foreach ($request->component as $key => $value) {
            if ($value != 0 && $value != null) {
                $salary_structure_component = SalaryStructureComponentModel::where('salary_structure_id',$salary_structure->id)->where('salary_component_id',$key)->first();
                $salary_structure_component->amount = $value;
                $salary_structure_component->save();
            }
        }

        Toastr::success('Salary Structure Update Successfully!!', 'success', ["positionClass" => "toast-top-right"]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SalaryStructureComponentModel::whereIn('salary_structure_id',[$id])->delete();
        SalaryStructureModel::where('id',$id)->delete();
        Toastr::success('Salary Structure Deleted Successfully!!', 'success', ["positionClass" => "toast-top-right"]);
        return back();
    }



    public function GetEmployee(Request $request){
        $requested_data = $request->data;
        $employee = SalaryStructureModel::get();
        $employee_id =$employee->pluck('employee_basic_info_id')->unique()->toArray();

        $data = EmployeModel::where(function($query) use ($requested_data) {
            if ($requested_data['branch_id']) {
                $query->where('branch_name', $requested_data['branch_id']);
            }
            if ($requested_data['designation_id']) {
                $query->where('designation_name', $requested_data['designation_id']);
            }
            if ($requested_data['designation_id']) {
                $query->where('designation_name', $requested_data['designation_id']);
            }
        })->whereNotIn('id',$employee_id)->get();

        return response()->json($data);
    }
}
