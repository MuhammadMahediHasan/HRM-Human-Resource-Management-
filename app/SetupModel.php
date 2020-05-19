<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SetupModel extends Model
{
    protected $table = "setup";
    protected $primaryKey = "id";
    protected $fillable = ['name','phone','email','address'];

    public function validation()
    {
    	return [
    		"name"=>'required',
    		"phone"=>'required',
    		"email"=>'required',
            "address"=>'required',
    	];
    }
}
