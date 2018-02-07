<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compoequipo extends Model
{
	protected $dates=['desde','hasta'];
	protected $table ='equipos_composicion';
	public $timestamps = false;
    //
}
