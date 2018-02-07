<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sustitucion extends Model
{
	protected $dates=['desde','hasta'];
	protected $table ='sustituciones';
	public $timestamps = false;
    //
}
