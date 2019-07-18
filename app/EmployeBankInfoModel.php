<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeBankInfoModel extends Model
{
    protected $table='employe_bank_info';
    protected $primaryKey='employe_bank_info_id';
    protected $fillable=['employe_basic_info_id','bank_account_number','bank_name','bank_Branch_name'];
}
