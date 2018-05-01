<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Dia;
use App\Equipo;
use App\Comnpoequipo;
use App\Bosquejo;
use App\Punto;
use App\Puntosdetalle;
use App\Clave;
use App\Chaman;
use App\Incidencia;
use App\Sustitucion;
use App\Externo;




class Calculo {

	private $fecha;
	private $diaSemana;
	private $festivo;
	private $arrayEquipos;
	private $equipoGuardia;
	private $aPuntosGuardia;
	private $aPersonalGuardia;
	private $aPuntoPersonaGuardia;

	 
	public function __construct($fecha,$finicio){
			$this->fecha = $fecha;
			$this->festivo = $this->laFechaesFiesta($fecha);
			$this->diaSemana = $this->getDiadelaSemana($this->fecha->format('l'));
			$this->arrayEquipos = Equipo::orderBy('orden')->get();
			$this->equipoGuardia = $this->getEquipodeGuardia($finicio,$fecha);
			if ($this->equipoGuardia==null) dd('Error no hay equipo de guardia para ese día');

			
			$this->aPuntosGuardia= $this->getColeccionPuntosGuardia();           
            $this->aPersonalGuardia = $this->getPersonalGuardia();
            // $this->aPuntoPersonaGuardia = $this->getPuntosPersonasGuardia($finicio,$fecha);
            // $this->getChamanes();
            $this->aPuntoPersonaGuardia = $this->reparte($finicio,$fecha);
            
            $this->borraBosquejo($fecha);
            $this->grabaBosquejo($fecha);
           



            
             //dd($this->aPuntoPersonaGuardia);
            // dd($this->equipoGuardia->descripcion);
             //dd($this->festivo.'||'.$this->diaSemana.'||'.$this->aPuntosGuardia.'||'.$this->equipoGuardia.'||'.$this->aPersonalGuardia.'||');
	}

	private function borraBosquejo($fecha){



		$result=Bosquejo::where([['fecha', $fecha->format('Y-m-d')],['bloqueado',0]])->delete();
		//dd($result);
	}
	private function grabaBosquejo($fecha){
 		$allintests = [];
    	foreach($this->aPuntoPersonaGuardia as $item){ //$intersts array contains input data
    		
	        	$intestcat = new Bosquejo();
	        	$intestcat->id = null;
	        	$intestcat->fecha= $fecha->format('Y-m-d');
	        	$intestcat->idturno = $item->idturno;
	        	$intestcat->idpunto = $item->idpunto;
	        	if ($item->idpersona) 
	        		$intestcat->idpersona = $item->idpersona;
	        	else
	        		$intestcat->idpersona = 0;

	        	$intestcat->bloqueado= 0;

	        	$allintests[] = $intestcat->attributesToArray();

        	  //$intestcat->save();
    	}
    	Bosquejo::insert($allintests);
    	


	}
	 
	public function esFestivo(){
			return $this->festivo;	
	}

	public function diadelaSemana(){
			return $this->diaSemana;
	}

	public function equipoGuardia(){
			return $this->EquipoGuardia;
	}

	public function puntosGuardia(){
			return $this->aPuntosGuardia;
	}

	public function dameGuardia(){
			return $this->aPuntoPersonaGuardia;
	}

	private function laFechaesFiesta($fecha){

			if (Dia::where('fecha',$this->fecha->format('Y-m-d'))->first()) 				
			 	return true;
			else
				return false;

	}

	private function getDiadelaSemana($dia){
			switch (strtoupper($dia)) {
    			case "MONDAY":
    				return 'lunes';
    				break;
    			case "TUESDAY":
    				return 'martes';
    				break;
    			case "WEDNESDAY":
    				return 'miercoles';
    				break;
    			case "THURSDAY":
    				return 'jueves';
    				break;
    			case "FRIDAY":
    				return 'viernes';
    				break;
    			case "SATURDAY":
    				return 'sabado';
    				break;
    			case "SUNDAY":
    				return 'domingo';
    				break;
    		}

	}
	private function getEquipodeGuardia($inicio,$fecha) {


    

    		// con criterio de fecha Genesis asumo primer punto con primera persona del equipo 1
			

			
            $ndias = $fecha->diffInDays($inicio);

            
            $x=$ndias%count($this->arrayEquipos);
			
            $y=0;
			// dd($fecha->format('Y-m-d').'-'.$inicio->format('Y-m-d').'||'.$ndias.'||'.$x);
            foreach ($this->arrayEquipos as $value) {
            	
            	if ($x==$y) {
            		return $value;
            		break;
            	}
            	$y++;           	
            }

            return null;
            // ya tenemos EquipoGuardia Calculado.




	}

	private function getColeccionPuntosGuardia() {
			// pasamos al calculo de los puntos de guardia....
            // Segun el día creo una array de los puntos de guardia que hay que cubrir.
            if ($this->festivo)
            	$strinDia='festivo';
            else
            	$strinDia=$this->diaSemana;

            
            	return  Puntosdetalle::where($strinDia,1)
            	->select('puntos_detalle.idpunto','puntos.descripcion','puntos_detalle.idturno')
            	->join('puntos','puntos_detalle.idpunto','puntos.id')
            	->where('puntos.guardia',1)
            	->get();
    }

    private function getPersonalGuardia() {
    	// dd($this->equipoGuardia);
    	$apersonalGuardia = Compoequipo::select('idpersona')
            ->where([['idequipo',$this->equipoGuardia->id],['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])          
            ->orwhere([['idequipo',$this->equipoGuardia->id],['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])
            ->orderBy('id')
            ->get();

        // Filtro array para eliminar los que tengan incidencias y sustituir los que tengan sustituciones

        $new = $apersonalGuardia->filter(function($persona)
    	{

    		$inci= Incidencia::select('id')
    			->where([['idpersona',$persona->idpersona],['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])
	    		->orwhere([['idpersona',$persona->idpersona],['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])
	    		->first();

        	if ($inci) {
        		// busco en sustituciones para cambiar el idpersona y si no hay sustitución retorno false
        		$sust = Sustitucion::select('idpersona_externa')
        		->where([['idpersona',$persona->idpersona],['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])
	    		->orwhere([['idpersona',$persona->idpersona],['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])
	    		->first();
	    		if ($sust) {

	    			$persona->idpersona=Externo::select('idpersona')->where('id',$sust->idpersona_externa)->first()->idpersona;

	    			return true;
	    		}
	    		else
            		return false;
        	}
            else
            	return true;
        	
    	});

        
        return  $new;
    }

    private function getPuntosPersonasGuardia($inicio,$fecha) {
    		
    		// busco ndias (segun cadencia) 

            $ndiasclave= Clave::count();
            $ndias = $fecha->diffInDays($inicio);
            $e=0;

           // localizo la posición del equipo que le toca guardia  
            foreach ($this->arrayEquipos as $equipo) {
            	if ($equipo == $this->equipoGuardia)
            		break;
            	else
            		$e++;
            } 
           
            // resto la posicón del equipo que le toca, los dias que tuvieron que pasar desde el genesis hasta que le tocara a este equipo por primera vez
            
            $ndias = $ndias - $e;
			
            $arrayAsignaciones = array();
            
            $z=0; // contador de puntos para ajustar persona;
            $r=0; // contador de puntos despachados ...
            $q=count($this->aPersonalGuardia); // numero de personas del equipo
      		$x=0;
			
            for ( $i=1; $i <= $ndias; $i = $i+$ndiasclave ){
            		
            		if ( $x >= ($q-1) )  $x = 0;
            		else $x++;
            		
            } 

       
            foreach ($this->aPuntosGuardia as  $punto) {
            	$obj = new \stdClass();
            	$obj->idpunto=$punto->idpunto;
            	$obj->idpersona=null;
            	$obj->idturno=$punto->idturno;
          	
            	$y=0;
				
            	foreach ($this->aPersonalGuardia as  $persona) {

					if ( $r >= $q ) 
						break; // Si estan todos asignados salgo ...

            		if ( $y == ($z + $x) ){  

            			$obj->idpersona=$persona->idpersona;

            			if ( $y >= ($q-1) ) { $x=0; $z=-1; }  // si la asignada es la ultima reinicio contadores para seguir por el principio
              			break;
            		}
            		$y++;
            							           		
            	}
				$arrayAsignaciones[]=$obj;
				$z++;
				$r++;
            	
            	
            	         
            }
            return 	$arrayAsignaciones;		
    }

    private function getChamanes(){
    	$this->aPuntoPersonaGuardia = array();
    	$chamanes=Chaman::select('*')
    	    ->where([['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])          
            ->orwhere([['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])->get();
            
 			foreach($chamanes as $pu){
            	 $pu->idpersona=$this->damesustituto($pu->idpersona);
            	 if ($pu->idpersona == null) unset($pu);
            	}
       

            
        foreach($chamanes as  $chaman) {
			if ($this->festivo)
            	$strinDia='festivo';
            else
            	$strinDia=$this->diaSemana;

            
            	$p = Puntosdetalle::select('puntos_detalle.idpunto')
            	->where([[$strinDia,1],['idturno',$chaman->idturno],['idpunto',$chaman->idpunto]])    
            	->get();
            	//dd($p);
            	if (count($p)>0) {
					$obj = new \stdClass();
            		$obj->idpunto=$chaman->idpunto;
            		$obj->idpersona=$chaman->idpersona;
            		$obj->idturno=$chaman->idturno;
					$this->aPuntoPersonaGuardia[]=$obj;
				}
        }


    }

    private function reparte($finicio,$fecha) {

    	$this->getChamanes();
    	//dd($this->aPuntoPersonaGuardia);
    	$clave=Clave::orderBy('orden')->get();
        $ndiasclave= Clave::count();
        $ndias = $fecha->diffInDays($finicio);
        $e=0;
        $posicionclave=$ndias%$ndiasclave;
        // dd($posicionclave,$ndias,$ndiasclave);
        $idsturnos=array();
         //objetos de idturno relacionado con idequipo que le corresponde hacer ese turno

		// $posicionclave es el numero del elemento de la clave que le toca realizar al equipo 1
        

        
       $arr=array();
        $e=$posicionclave;
        while ($e>=0) {
        	$arr[]=$e;
        	$e--;
        }
        $e=$ndiasclave-1;
        while (count($arr)<$ndiasclave) {
        	$arr[]=$e;
        	$e--;
        }
		$cont=0;
        while (count($idsturnos) != count($arr)) {
        	$e=0;      	
			foreach ($clave as $value) {
				if ($arr[$cont]==$e) {
					$obj = new \stdClass();
	         		$obj->idturno=$value->idturno;
	         		$obj->idequipo=$arr[$cont]+1;
	         		$obj->aidpersonas= array();
	         		$obj->aidpuntos = array();
	         		$idsturnos[] = $obj;
	         		$cont++; 
	         		break;
				}
				$e++;

			}
				


		} 
        
        // Asigno equipos por orden....
		$cont=0;
        foreach ($this->arrayEquipos as $equipo) {        		
       		  	$idsturnos[$cont]->idequipo=$equipo->id;
 	      		$cont++;
			} 

// comenzamos a aasignar personas por equipos teniendo en cuenta el orden para asignar el punto correcto.

        if ($this->festivo)
          	$strinDia='puntos_detalle.festivo';
        else
          	$strinDia='puntos_detalle.'.$this->diaSemana;
    
        foreach ($idsturnos as  $value){

               	$p = Punto::select('puntos.id')
               	->join('puntos_detalle','puntos.id','puntos_detalle.idpunto')
               	->orderBy('puntos.prioridad')
            	->where([[$strinDia,1],['puntos_detalle.idturno',$value->idturno]])  
            	->get();
            	
            	foreach($p as $pu){  
					
						$value->aidpuntos[]=$pu->id;
            	 	}

              	$p2 = Compoequipo::select('equipos_composicion.idpersona')
               	->orderBy('equipos_composicion.id')
            	->where([['equipos_composicion.idequipo',$value->idequipo],['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])          
            	->orwhere([['equipos_composicion.idequipo',$value->idequipo],['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])
            	->get();
            	
            	foreach($p2 as $pu){

            		$value->aidpersonas[]=$this->damesustituto($pu->idpersona);
            	
            	}


        }

		$arrayAsignaciones = $this->aPuntoPersonaGuardia;
		//dd($idsturnos,$arrayAsignaciones);

		foreach ($idsturnos as  $turno){	

            	foreach ($arrayAsignaciones as  $chama) {

            		if ($turno->idturno == $chama->idturno) {
            			foreach ($turno->aidpuntos as $key => $pun){ 

            				if ($pun == $chama->idpunto) 
            					unset($turno->aidpuntos[$key]);
            						

            						
            			}

            		}
            	}
        }
		


        foreach ($idsturnos as $key => $value) {
        	
        	foreach ($idsturnos as $key2 => $value2) {
        		
        		if (($value->idturno==$value2->idturno) && ($value != $value2)) {
        			$sw=0;
        			$arr=array();
        			if (count($value->aidpuntos) > count($value->aidpersonas)) {
        				foreach ($value->aidpuntos as $i => $pu1){
        					$sw++;
        					if (count($value->aidpersonas)<$sw){
        						$arr[]=$value->aidpuntos[$i];
        						unset($value->aidpuntos[$i]);

        					}
        				} 

                  /// continuar aqui limpiar arrays para buena rotacion
        				foreach ($value2->aidpuntos as $j =>$pu2)
	      						unset($value2->aidpuntos[$j]);
        				foreach ($arr as $key4 => $punt) 
        						$value2->aidpuntos[]=$punt;
        				while (count($value2->aidpersonas) != count($value2->aidpuntos)){
        					if (count($value2->aidpersonas) < count($value2->aidpuntos))
        						$value2->aidpersonas[]=0;
        					else
        						$value2->aidpuntos[]=0;
        				}
        			}

        		}

        	}
        	
        }
        // limpieza
		foreach($idsturnos as $value){
			foreach($value->aidpuntos as $key => $pun){
				if ($pun==0)
					unset($value->aidpuntos[$key]); 
			}
			foreach($value->aidpersonas as $key => $per){
				if ($per==0)
					unset($value->aidpersonas[$key]); 
			}
		}
		// en caso de mas personas que puntos y repetimos turno elimino los puntos del segundo repetido

		foreach ($idsturnos as $key => $value) {
        	
        	foreach ($idsturnos as $key2 => $value2) {
        		
        		if (($value->idturno==$value2->idturno) && ($value != $value2) && (count($value->aidpuntos)<>0)) {
        			$sw=0;
        			$arr=array();
        			if (count($value->aidpersonas) > count($value->aidpuntos)) {
        				foreach ($value2->aidpuntos as $j =>$pu2)
	      						unset($value2->aidpuntos[$j]);
        				
        			}

        		}

        	}
        	
        }



         //dd($idsturnos);

  /*      for ($i=0 ; $i<count($idsturnos) ; $i++){
			$it=$idsturnos[$i]->idturno;
			for ($j=$i+1; $j<count($idsturnos) ; $j++){
				if ($it==$idsturnos[$j]->idturno) {
					$sw=0;
					for ($q=count($idsturnos[$i]->aidpersonas);$q<=count($idsturnos[$i]->aidpuntos)-1; $q++){
						$idsturnos[$i]->aidpuntos[$q]=0;
						$sw++;						
					}
					for ($q=0;$q<=(count($idsturnos[$i]->aidpuntos)-$sw); $q++)
						$idsturnos[$j]->aidpuntos[$q]=0;

					
				}
					
			}
		} */

		



// limpieza
		foreach($idsturnos as $value){
			foreach($value->aidpuntos as $key => $pun){
				if ($pun==0)
					unset($value->aidpuntos[$key]); 
			}
			foreach($value->aidpersonas as $key => $per){
				if ($per==0)
					unset($value->aidpersonas[$key]); 
			}
		}

/*			$indice=1;
			while ($indice != false) {
				$indice = array_search(0,$value->aidpuntos,true);
				
				if ($indice != false)
					unset($value->aidpuntos[$indice]);
				
			}
		}

*/
	


/*
		for ($i=0 ; $i<count($idsturnos) ; $i++){
			for ($j=0; $j<count($idsturnos[$i]->aidpuntos) ; $j++){
				if ($idsturnos[$i]->aidpuntos[$j]==0) {
					unset($idsturnos[$i]->aidpuntos[$j]);
				}
					
			}
		} */
// dd($idsturnos);
	
/*
		for ($i=0 ; $i<count($idsturnos) ; $i++){
			$it=$idsturnos[$i]->idturno;
			for ($j=$i+1; $j<count($idsturnos) ; $j++){
				if ($it==$idsturnos[$j]->idturno) {
					foreach ($idsturnos[$j]->aidpersonas as  $value) {
						$idsturnos[$i]->aidpersonas[]=$value;

					}
					$idsturnos[$j]->idturno=0;
				}
			}

		}

		//// Evitar eliminar este turno repetido para que roten los puntos.......
		for ($i=0 ; $i<=count($idsturnos)-1 ; $i++){
			 
			if($idsturnos[$i]->idturno==0){
				unset($idsturnos[$i]);

			}

		}

*/
		


		$ndias=$ndias-$posicionclave;


            foreach ($idsturnos as $turno){

            	if (count($turno->aidpuntos) > 0){

            		$q=count($turno->aidpersonas); // numero de personas del equipo, ahora del mismo turno
      				
      				$z=0; // contador de puntos para ajustar persona;
            		$r=0; // contador de puntos despachados ...
            		$x=0;
			
            		for ( $i=1; $i <= $ndias; $i=$i+$ndiasclave ){         		
            			if ( $x >= ($q-1) )  $x = 0;
            				else $x++;
            		} 

      				foreach($turno->aidpuntos as  $punto){
      					$obj = new \stdClass();
            			$obj->idpunto=$punto;
            			$obj->idpersona=null;
            			$obj->idturno=$turno->idturno;
          	
            			$y=0;

            			foreach($turno->aidpersonas as  $persona){
            				if ( $r >= $q ) 
								break; // Si estan todos asignados salgo ...

            				if ( $y == ($z + $x) ){  

            					$obj->idpersona=$persona;

            					if ( $y >= ($q-1) ) { $x=0; $z=-1; }  // si la asignada es la ultima reinicio contadores para seguir por el principio
              						break;
            				}
            				$y++;

            			}
            			$arrayAsignaciones[]=$obj;
						$z++;
						$r++;

      				}



            	}

            }

            return 	$arrayAsignaciones;
    }







    private function damesustituto($idpersona){
    		$inci= Incidencia::select('id')
    			->where([['idpersona',$idpersona],['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])
	    		->orwhere([['idpersona',$idpersona],['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])
	    		->first();

        	if ($inci) {
        		// busco en sustituciones para cambiar el idpersona y si no hay sustitución retorno false
        		$sust = Sustitucion::select('idpersona_externa')
        		->where([['idpersona',$idpersona],['desde','<=',$this->fecha->format('Y-m-d')] , ['hasta',null]])
	    		->orwhere([['idpersona',$idpersona],['desde','<=',$this->fecha->format('Y-m-d')],['hasta','>=',$this->fecha->format('Y-m-d')]])
	    		->first();
	    		if ($sust) {

	    			return Externo::select('idpersona')->where('id',$sust->idpersona_externa)->first()->idpersona;

	    			
	    		}
	    		else
            		return null;
        	}
            else
            	return $idpersona;
        	
    	}           


    
 
}



 
?>
