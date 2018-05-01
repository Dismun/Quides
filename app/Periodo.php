<?php



use App\Externo;
use App\Compoequipo;
use App\Chaman;
use App\Persona;
use Carbon\Carbon;

class Periodo
{


  public function __construct($idpersona){
      
     
      // busco periodos de la persona en tablas
      
      $array1 = Externo::select('desde','hasta')->where('idturno','=',$idpersona);
      $array2 = Chaman::select('desde','hasta')->where('idturno','=',$idpersona);
      $array3 = Compoequipo::select('desde','hasta')->where('idturno','=',$idpersona);

      $arrayFechas = array_merge($array1,$array2,$array3);
      dd($arrayFechas);
      
 }



 }


