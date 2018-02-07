<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sabadosydomingo extends Model
{
	protected $dates=['desde','hasta'];
	protected $table ='sabadosydomingos';
	public $timestamps = false;
    //
}
