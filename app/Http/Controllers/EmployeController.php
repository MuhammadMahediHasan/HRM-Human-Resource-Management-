<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\BranchModel;
use App\DepartmentModel;
use App\DesignationModel;
use App\EmployeModel;
use App\EmployeContactInfoModel;
use App\EmployeBankInfoModel;
use App\EmployeJoiningDetailsModel;
use App\EmployePersonalBioModel;
use Validator;
use Toastr;
use Redirect;
use Hash;
use File;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branch=BranchModel::all();
        $department=DepartmentModel::all();
        $designation=DesignationModel::all();
        return view('employe.add_employe',['branch'=>$branch,'department'=>$department,'designation'=>$designation]);
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
        // dd($request->all());
        $employe_basic_data=new EmployeModel;
        $requested_data=$request->all();
        $validate=Validator::make($request->all(),$employe_basic_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        
        $employe_basic_data->password = Hash::make($request->password);
        $employe_basic_data->fill($requested_data)->save();

        Toastr::success('Employee Added Successfully', '', ["positionClass" => "toast-top-right"]);
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
        $employe_data=EmployeModel::join('employe_contact_info','employe_contact_info.id','=','employe_basic_info.id')
                    ->join('employe_bank_info','employe_bank_info.id','=','employe_basic_info.id')
                    ->join('employe_joining_info','employe_joining_info.id','=','employe_basic_info.id')
                    ->join('employe_personal_bio','employe_personal_bio.id','=','employe_basic_info.id')
                    ->join('department','employe_basic_info.department_name','=','department.department_id')
                    ->join('branch','branch.branch_id','=','employe_basic_info.branch_name')
                    ->join('designation','designation.designation_id','=','employe_basic_info.designation_name')
                    ->findOrFail($id);
        $branch=BranchModel::where('branch_status','Active')->get();           
        $designation=DesignationModel::where('designation_status','Active')->get();           
        $department=DepartmentModel::where('department_status','Active')->get();           
        return view('employe.employe_edit',['employe_data'=>$employe_data,'branch'=>$branch,'designation'=>$designation,'department'=>$department]);            
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
        //dd($request->all());
        $employe_basic_data=EmployeModel::findOrFail($id);
        $requested_data=$request->all();
        $validate=Validator::make($request->all(),$employe_basic_data->validation());
        if ($validate->fails()) 
        {
            return back()->withInput()->withErrors($validate);
        }
        else
        {
            if($request->hasFile('employe_photo'))
            {
                $image_type=$request->file('employe_photo')->getClientOriginalExtension();
                $path="backend_asset/images/employe_photo/";
                $name=time().".".$image_type;
                $full_path=$path.$name;
                $request->file('employe_photo')->move($path,$name);
                $requested_data=array_set($requested_data,'employe_photo',$full_path);


                if(File::exists(asset($employe_basic_data->employe_photo)))
                {
                    File::delete(asset($employe_basic_data->employe_photo));
                }

            }
            $employe_basic_data->fill($requested_data)->save();
            //Employee Contact Info
            $id=$employe_basic_data->id;
            $employe_contact_data=EmployeContactInfoModel::findOrFail($request->employe_contact_info_id);

            $employe_contact_data->id =$id;
            $employe_contact_data->phone_number =$request->phone_number;
            $employe_contact_data->email =$request->email;
            $employe_contact_data->present_address =$request->present_address;
            $employe_contact_data->parmanent_address =$request->parmanent_address;
            $employe_contact_data->save();

            //Employee Bank Info
            $employe_bank_data=EmployeBankInfoModel::findOrFail($request->employe_bank_info_id);
            $employe_bank_data->id =$id;
            $employe_bank_data->bank_account_number =$request->bank_account_number;
            $employe_bank_data->bank_name =$request->bank_name;
            $employe_bank_data->bank_Branch_name =$request->bank_Branch_name;
            $employe_bank_data->save();

            //Employee Joining Info
            $employe_joining_details_data=EmployeJoiningDetailsModel::findOrFail($request->employe_joining_info_id);
            $employe_joining_details_data->id =$id;
            $employe_joining_details_data->offer_date =$request->offer_date;
            $employe_joining_details_data->confirmation_date =$request->confirmation_date;
            $employe_joining_details_data->joining_date =$request->joining_date;
            $employe_joining_details_data->save();

            //Employee Personal Bio Info
            $employe_personal_bio_data=EmployePersonalBioModel::findOrFail($request->employe_personal_bio_id);
            $employe_personal_bio_data->id =$id;

            if($request->hasFile('cv'))
            {
                $image_type=$request->file('cv')->getClientOriginalExtension();
                $path="backend_asset/images/cv/";
                $name=$request->employe_name."_cv".".".$image_type;
                $full_path=$path.$name;
                $request->file('cv')->move($path,$name);
                $requested_data=array_set($requested_data,'cv',$full_path);


                if(File::exists(asset($employe_personal_bio_data->cv)))
                {
                    File::delete(asset($employe_personal_bio_data->cv));
                }

            }
            $employe_personal_bio_data->cv=$full_path;
            $employe_personal_bio_data->save();

            Toastr::success('Employee Updated Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EmployeModel::findOrFail($id)->delete();
        EmployeContactInfoModel::where('id',$id)->delete();
        EmployeBankInfoModel::where('id',$id)->delete();
        EmployeJoiningDetailsModel::where('id',$id)->delete();
        EmployePersonalBioModel::where('id',$id)->delete();

        Toastr::success('Employee Deleted Successfully', '', ["positionClass" => "toast-top-right"]);
            return back();
    }


    public function employe_report()
    {
        $department=DepartmentModel::where('department_status','Active')->get();
        return view('employe.employe_report',['department'=>$department]);
    }



    public function get_employe_report(Request $request)
    {
        $employe_report=EmployeModel::join('branch','branch.branch_id','=','employe_basic_info.branch_name')
                                    ->where('employe_basic_info.department_name',$request->department)
                                    ->get();
        return view('employe.employe_report_sheet',['employe_report'=>$employe_report]);
    }


    public function view_bio(Request $request)
    {
        return EmployeModel::join('employe_contact_info','employe_contact_info.id','=','employe_basic_info.id')
                    ->join('employe_bank_info','employe_bank_info.id','=','employe_basic_info.id')
                    ->join('employe_joining_info','employe_joining_info.id','=','employe_basic_info.id')
                    ->join('employe_personal_bio','employe_personal_bio.id','=','employe_basic_info.id')
                    ->join('department','employe_basic_info.department_name','=','department.department_id')
                    ->join('branch','branch.branch_id','=','employe_basic_info.branch_name')
                    ->join('designation','designation.designation_id','=','employe_basic_info.designation_name')
                    ->where('employe_basic_info.id',$request->id)
                    ->first();
    }



    public function download_cv(Request $request)
    {    
        $file = $request->cv;
        return Response::download($file);
    }

}
