<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dia extends Model
{
	protected $table ='calendario_laboral';
	protected $dates = ['fecha'];
	public $timestamps = false;
	// $this.setDateFormat('d-m-y');
    //
}
