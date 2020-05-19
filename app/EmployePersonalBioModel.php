<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployePersonalBioModel extends Model
{
    protected $table='employe_personal_bio';
    protected $primaryKey='employe_personal_bio_id';
    protected $fillable=['id','cv'];
}
