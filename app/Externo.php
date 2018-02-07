<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Externo extends Model
{
	protected $dates=['desde','hasta'];
	protected $table ='persona_externos';
	public $timestamps = false;
    //
}
