<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chaman extends Model
{
	protected $dates=['desde','hasta'];
	protected $table ='chamanes';
	public $timestamps = false;
    //
}
