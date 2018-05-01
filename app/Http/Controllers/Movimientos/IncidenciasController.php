<?php
namespace App\Http\Controllers\Movimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Incidencia;
use App\Persona;
use App\Tipoincidencia;
use App\Externo;
use Carbon\Carbon;




class IncidenciasController extends Controller
{
     public function getIndex()
    {
        $arrayIncidencias = Incidencia::join('tipos_incidencias', 'incidencias.idincidencia','=', 'tipos_incidencias.id')
        ->join('personas', 'incidencias.idpersona','=', 'personas.id')
        ->select('incidencias.*', 'personas.nombre', 'tipos_incidencias.descripcion')->orderBy('incidencias.desde','desc')
        ->orderBy('incidencias.id')->get();

        foreach ($arrayIncidencias as $key => $inci) {
        	if ($inci->hasta)
        	    $inci->dias= ($inci->hasta->diffInDays($inci->desde))+1;
        	else
        		if (Carbon::now() > $inci->desde)
        			$inci->dias = (Carbon::now()->diffInDays($inci->desde))+1;
        		else
        			$inci->dias = "1";
        }

       

        return view('movimientos.incidencias.index',compact('arrayIncidencias'));
    

    }

 	public function getEdit($id)
    {
    	$arrayIncidencias = Incidencia::join('tipos_incidencias', 'incidencias.idincidencia','=', 'tipos_incidencias.id')
        ->join('personas', 'incidencias.idpersona','=', 'personas.id')
        ->select('incidencias.*', 'personas.nombre', 'tipos_incidencias.descripcion')->orderBy('incidencias.desde','desc')
        ->orderBy('incidencias.id')->get();

        $incidenciae=Incidencia::find($id);

        $fhasta=null;
                
        return view('movimientos.incidencias.edit',compact(['incidenciae','arrayIncidencias','fhasta']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$incidencia = Incidencia::find($id);
    	
    	$incidencia->hasta=$request->input('hasta');
    	
      	$incidencia->save();

    	Session::flash('message','El Incidencia '.$incidencia->descripcion.' se ha modificado correctamente!');
    	
 		return redirect('incidencias');       
    } 

     public function getInsertar(Request $request)
    {

        $arrayIncidencias = Incidencia::join('tipos_incidencias', 'incidencias.idincidencia','=', 'tipos_incidencias.id')
        ->join('personas', 'incidencias.idpersona','=', 'personas.id')
        ->select('incidencias.*', 'personas.nombre', 'tipos_incidencias.descripcion')->orderBy('incidencias.desde','desc')
        ->orderBy('incidencias.id')->get();

        $fdesde = Carbon::createFromFormat('Y-m-d', $request->input('fdesde')) ;
        $fdesde->hour = 00;
        $fdesde->minute = 00;
        $fdesde->second = 00;

        $arrayPersonas=$this->posiblesIncidentes($fdesde,$arrayIncidencias);

         // Persona::select('id','nombre')->where('activo','=','1')->orderBy('nombre')->get();
        $arrayTiposincidencias=Tipoincidencia::select('id','descripcion')->orderBy('descripcion')->get();
        
       /*
        

        foreach ($arrayPersonas as $persona)
        {
            $persona->fhasta = null;
        }


           $new = $arrayPersonas->filter(function($persona) use($arrayIncidencias, $fdesde) 
            {
                $sw=1;
                foreach ($arrayIncidencias as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            
                            if ((is_null($persona2->hasta)) and ($persona2->desde->format('Y-m-d') <= $fdesde)) {
                                $sw=0;
                            }
                            else {
                                if  (($persona2->desde->format('Y-m-d') <= $fdesde) and ($persona2->hasta->format('Y-m-d') >= $fdesde)) {

                                    $sw=0;
                                }
                                else {
                                    $persona->fhasta =$persona2->desde->subDay(1)->format('Y-m-d');
                                }

                            }
                        }
                      
                    }
                return $sw;
            });
        
			$arrayPersonas = $new ;

        

  */



		return view('movimientos.incidencias.create',compact(['arrayIncidencias','arrayPersonas','arrayTiposincidencias','fdesde']));

    }


    public function postInsertar(Request $request)
    {
        $incidencia = new Incidencia;
        
        $incidencia->idincidencia=$request->input('idincidencia');
        $incidencia->idpersona=$request->input('idpersona');
		$incidencia->desde=$request->input('desde');
		$incidencia->hasta=$request->input('hasta');
        $incidencia->save();
        Session::flash('message','El Incidencia '.$incidencia->descripcion.' ha sido almacenado corectamente!');
        
        return redirect('incidencias');
        
    }
    
	public function postDelete($id)
    {
    	$incidencia = Incidencia::find($id);
    	
    	$incidencia->delete();
        Session::flash('message','El Incidencia '.$incidencia->descripcion.' ha sido eliminado!');

    	return redirect('incidencias');
        
    }
    public static function posiblesIncidentes(Carbon $fecha, $arrayIncidencias)
    {
         /* Personas que no son externos, son chamanes o forman parte de algun equipo y  durante la fechas indicada */
        $arrayPosibles= Persona::select('personas.id','personas.nombre')->where('activo','=','1')
        ->orderBy('personas.nombre')
        ->get();  /* continuar que aparezcan todos menos externos en esa fecha */

        $arrayExternos=Externo::select('persona_externos.idpersona','persona_externos.desde','persona_externos.hasta')
        ->where([['persona_externos.desde','<=',$fecha->format('Y-m-d')],['persona_externos.hasta','=',null]])
        ->orwhere([['persona_externos.desde','<=',$fecha->format('Y-m-d')],['persona_externos.hasta','>=',$fecha->format('Y-m-d')]])
        ->get();

        $new = $arrayPosibles->filter(function($persona) use($arrayExternos, $fecha) 
            {
                $sw=1;
                foreach ($arrayExternos as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            
                            if ((is_null($persona2->hasta)) and ($persona2->desde <= $fecha)) {
                                $sw=0;
                            }
                            else {
                                if  (($persona2->desde <= $fecha) and ($persona2->hasta >= $fecha)) {

                                    $sw=0;
                                }
                                else {
                                    $persona->hasta =$persona2->desde->subDay(1);
                                }

                            }
                        }
                      
                    }
                return $sw;
            });
        
            

        $arrayPosibles=$new;
        /* eliminamos los que ya estén en incidencias */
        $new = $arrayPosibles->filter(function($persona) use($arrayIncidencias, $fecha) 
            {
                $sw=1;
                foreach ($arrayIncidencias as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            
                            if ((is_null($persona2->hasta)) and ($persona2->desde <= $fecha)) {
                                $sw=0;
                            }
                            else {
                               // dd($persona2->desde.' - '.$persona2->hasta.' ->'.$fecha);
                                if  (($persona2->desde <= $fecha) and ($persona2->hasta >= $fecha)) {
                                    $sw=0;
                                }
                                else {
                                    $persona->hasta =$persona2->desde->subDay(1);
                                }

                            }
                        }
                      
                    }
                return $sw;
            });
        
            

        //$new=$arrayPosibles;

        return $new;

    }
}