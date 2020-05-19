<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeModel extends Model
{
    protected $table='users';
    protected $primaryKey='id';
    protected $fillable=['employe_code','employe_name','branch_name','department_name','designation_name','date_of_birth','joining_date','gender','phone','email','password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function validation()
    {
    	return [
    		"employe_code"=>'required',
    		"employe_name"=>'required',
    		"branch_name"=>'required',
    		"department_name"=>'required',
    		"designation_name"=>'required',
    		"date_of_birth"=>'required',
            "joining_date"=>'required',
            "gender"=>'required',
            "phone"=>'required',
            "email"=>'required|email|unique:users',
            "password"=>'required|confirmed',
    	];
    }
}
