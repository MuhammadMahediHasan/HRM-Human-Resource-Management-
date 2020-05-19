<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeModel;
use App\DepartmentModel;
use App\BranchModel;
use App\EmployeTransferModel;
use Validator;
use Toastr;
use Redirect;


class EmployeTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch=BranchModel::where('branch_status','Active')->get();
        $department=DepartmentModel::where('department_status','Active')->get();

        $employe_transfer=EmployeTransferModel::join('employe_basic_info','employe_transfer.id','=','employe_basic_info.id')->get();
        return view('employe.employe_transfer',['branch'=>$branch,'department'=>$department,'employe_transfer'=>$employe_transfer]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employe_transfer_data=new EmployeTransferModel;
        $validate=Validator::make($request->all(),$employe_transfer_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            $employe_transfer_data->fill($request->all())->save();
            // return back();
            $id=$request->id;
            $employe_basic_info=EmployeModel::findOrFail($id);
            $employe_basic_info->update(['branch_name'=>$request->present_branch]);
            $employe_basic_info->update(['department_name'=>$request->present_department]);

            Toastr::success('Employee Transfer Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
        }
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


    public function get_employe_transfer_data(Request $request)
    {
        $employe_code=$request->employe_code;
        return EmployeModel::join('department','employe_basic_info.department_name','=','department.department_id')
                            ->join('branch','employe_basic_info.branch_name','=','branch.branch_id')
                            ->where('employe_code',$employe_code)->first();
    }
}
