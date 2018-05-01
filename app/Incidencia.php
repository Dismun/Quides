<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
	protected $dates=['desde','hasta'];
	protected $table ='incidencias';
	public $timestamps = false;
    //
}
