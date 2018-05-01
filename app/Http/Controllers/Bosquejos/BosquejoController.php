<?php
namespace App\Http\Controllers\Bosquejos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Bosquejo;
use App\Compoequipo;
use App\Equipo;
use App\Turno;
use App\Chaman;
use App\Incidencia;
use App\Persona;
use App\Externo;
use App\Punto;
use Carbon\Carbon;





class BosquejoController extends Controller
{
     public function getIndex($fecha)
    {

    	if ($fecha<>'null')
    		$fecha = Carbon::createFromFormat('Y-m-d', $fecha);
    	else
    		$fecha = Carbon::now();

       $arrayBosquejos = Bosquejo::join('personas', 'bosquejo.idpersona','=', 'personas.id')
        ->join('turnos', 'bosquejo.idturno','=', 'turnos.id')
        ->join('puntos', 'bosquejo.idpunto','=', 'puntos.id')
        ->join('centros','puntos.idcentro','=','centros.id')
        ->join('niveles','puntos.idnivel','=','niveles.id')
        ->select('bosquejo.*', 'personas.nombre','turnos.descripcion as descturno','puntos.descripcion as descpunto','centros.codigo','centros.color as ccolor','niveles.color as ncolor')
        ->where('fecha','=',$fecha->format('Y-m-d'))
        ->orderBy('puntos.guardia','desc')
        ->orderBy('puntos.prioridad')->get();
 
        foreach ($arrayBosquejos as $key => $value) {
            $ide=Compoequipo::select('id','idequipo')
                ->where([['idpersona', $value->idpersona],['desde','<=',$fecha->format('Y-m-d')],['hasta','=',null]])
                ->orwhere([['idpersona', $value->idpersona],['desde','<=',$fecha->format('Y-m-d')],['hasta','>=',$fecha->format('Y-m-d')]])
                ->first();
            $ide2=null;
            $ide3=null;

            $value->equipo=null;
            $value->ecolor=null;
            if ($ide) {
                $ide2=Equipo::Select('equipos.descripcion','equipos.color')->where('id','=',$ide->idequipo)->first();
                $value->idequipo=$ide->idequipo;
                $value->ordenidequipo=$ide->id;
            }
            else {
                $ide3=Chaman::Select('id')
                ->where([['idpersona', $value->idpersona],['desde','<=',$fecha->format('Y-m-d')],['hasta','=',null]])
                ->orwhere([['idpersona', $value->idpersona],['desde','<=',$fecha->format('Y-m-d')],['hasta','>=',$fecha->format('Y-m-d')]])
                ->first();
                if ($ide3==null){
                    $ide3=Externo::Select('id')
                        ->where([['idpersona', $value->idpersona],['desde','<=',$fecha->format('Y-m-d')],['hasta','=',null]])
                        ->orwhere([['idpersona', $value->idpersona],['desde','<=',$fecha->format('Y-m-d')],['hasta','>=',$fecha->format('Y-m-d')]])
                        ->first();
                        if ($ide3){
                            $value->equipo='Externo';
                            $value->ecolor='';
                            $value->idequipo=999999999999;
                            $value->ordenidequipo=9;

                        }
                }
                else {
                    $value->equipo='Chaman';
                    $value->ecolor='';
                    $value->idequipo=888888888888;
                    $value->ordenidequipo=8;
                }
            }

            if ($ide2) {
                $value->equipo=$ide2->descripcion;
                $value->ecolor=$ide2->color;
            }
            

            if ($value->equipo==null){
                $value->equipo='------';
                $value->ecolor='';
            }
        }


        $x=0;
        $sw = true;
        $bosque = null;
        while ($sw) {
             $sw = false;
             for ($x=0 ; $x < count($arrayBosquejos)-1 ; $x++) 
             {
               if ($arrayBosquejos[$x]->idequipo > $arrayBosquejos[$x+1]->idequipo) {
                  $bosque = $arrayBosquejos[$x];
                  $arrayBosquejos[$x]= $arrayBosquejos[$x+1]   ;
                  $arrayBosquejos[$x+1] = $bosque ;
                  $sw = true;       
               } else
               if (($arrayBosquejos[$x]->idequipo == $arrayBosquejos[$x+1]->idequipo) &
                    ($arrayBosquejos[$x]->ordenidequipo > $arrayBosquejos[$x+1]->ordenidequipo)) {
                    $bosque = $arrayBosquejos[$x];
                    $arrayBosquejos[$x]= $arrayBosquejos[$x+1]   ;
                    $arrayBosquejos[$x+1] = $bosque ;
                    $sw = true;     

              }
              
             }
            
        }
        

        return view('bosquejos.index',compact(['arrayBosquejos','fecha']));
    

    }

     public function getIndex2(Request $request)
    {
    	$fecha=$request->input('fecha');

        return redirect('bosquejos/'.$fecha);
    

    }


 	public function getEdit($id)
    {
		$bosquejoe=Bosquejo::find($id);
    	 $arrayBosquejos = Bosquejo::join('personas', 'bosquejo.idpersona','=', 'personas.id')
        ->join('turnos', 'bosquejo.idturno','=', 'turnos.id')
        ->join('puntos', 'bosquejo.idpunto','=', 'puntos.id')
        ->join('centros','puntos.idcentro','=','centros.id')
        ->join('niveles','puntos.idnivel','=','niveles.id')
        ->select('bosquejo.*', 'personas.nombre','turnos.descripcion as descturno','puntos.descripcion as descpunto','centros.codigo','centros.color as ccolor','niveles.color as ncolor')
        ->where('fecha','=',$bosquejoe->fecha->format('Y-m-d'))
        ->orderBy('puntos.guardia','desc')
        ->orderBy('puntos.prioridad')->get();

        $arrayPersonas = $this->posiblesPersonas($bosquejoe->fecha,$arrayBosquejos);
                
        return view('bosquejos.edit',compact(['bosquejoe','arrayBosquejos','arrayPersonas']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$bosquejo = Bosquejo::find($id);
    	
    	$bosquejo->idpersona=$request->input('idpersona');
    	
      	$bosquejo->save();

    	Session::flash('message','El Bosquejo  se ha modificado correctamente!');
    	
 		return redirect('bosquejos/'.$bosquejo->fecha->format('Y-m-d'));       
    } 

     public function getInsertar(Request $request)
    {
    	$fecha = Carbon::createFromFormat('Y-m-d', $request->input('fecha'));

        $arrayBosquejos = Bosquejo::join('personas', 'bosquejo.idpersona','=', 'personas.id')
        ->join('turnos', 'bosquejo.idturno','=', 'turnos.id')
        ->join('puntos', 'bosquejo.idpunto','=', 'puntos.id')
        ->join('centros','puntos.idcentro','=','centros.id')
        ->join('niveles','puntos.idnivel','=','niveles.id')
        ->select('bosquejo.*', 'personas.nombre','turnos.descripcion as descturno','puntos.descripcion as descpunto','centros.codigo','centros.color as ccolor','niveles.color as ncolor')
        ->where('fecha','=',$fecha->format('Y-m-d'))
        ->orderBy('puntos.guardia','desc')
        ->orderBy('puntos.prioridad')->get();

		$arrayTurnos = Turno::where('activo','=','1')->orderBy('desde')->orderBy('hasta')->get();
        

        $arrayPersonas= $this->posiblesPersonas($fecha,$arrayBosquejos);;

        /* Persona::select('id','nombre')->where('activo','=','1')->orderBy('nombre')->get(); */
        $arrayPuntos=Punto::orderBy('descripcion')->get();
		return view('bosquejos.create',compact(['arrayBosquejos','arrayPersonas','arrayTurnos','arrayPuntos','fecha']));

    }


    public function postInsertar(Request $request)
    {
        $bosquejo = new Bosquejo;
        $bosquejo->fecha=$request->input('fecha');
        $bosquejo->idpersona=$request->input('idpersona');
        $bosquejo->idturno=$request->input('idturno');
		$bosquejo->idpunto=$request->input('idpunto');
		$bosquejo->bloqueado=0;
        $bosquejo->save();
        Session::flash('message','La línea Bosquejo ha sido almacenada corectamente!');
        
        return redirect('bosquejos/'.$bosquejo->fecha->format('Y-m-d'));
        
    }
    
	public function postDelete($id)
    {
    	$bosquejo = Bosquejo::find($id);
    	
    	$bosquejo->delete();

        Session::flash('message','La Línea de Bosquejo ha sido eliminada!');

    	return redirect('bosquejos/'.$bosquejo->fecha->format('Y-m-d'));
        
    }
    public function postBloqueo($fecha)
    {
       
        Bosquejo::where('fecha',$fecha)->update(['bloqueado' => 1]);
        
       

        Session::flash('message','El día de Bosquejo ha sido bloqueado!');

        return redirect('bosquejos/'.$fecha);
        
    }


    
    public function posiblesPersonas($fecha, $arrayBosquejos)
    {
        /* Este select elimina de personal todos los ocupados o en incidencias */ 

        
        /* personal externo ordenado por tipo de contrato que esté disponible, es decir que no figure en incidencias y ni esté haciendo una sustitución en la fecha indicada */
        $arrayPosibles= Persona::select('personas.id','personas.nombre')
        ->where('activo','=','1')
        ->orderBy('personas.nombre')
        ->get();

        /* tenemos disponibles en externos y buscamos los externos que ya estan realizando bosquejos para quitarlos*/

        $new = $arrayPosibles->filter(function($persona) use($arrayBosquejos) 
            {
                $sw=1;
                foreach ($arrayBosquejos as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            $sw=0;
                        }
                      
                    }
                return $sw;
            });
        
         $arrayPosibles=$new; 

        $arrayIncidencias=Incidencia::select('incidencias.idpersona')
        ->where([['incidencias.desde','<=',$fecha->format('Y-m-d')],['incidencias.hasta','=',null]])
        ->orwhere([['incidencias.desde','<=',$fecha->format('Y-m-d')],['incidencias.hasta','>=',$fecha->format('Y-m-d')]])
        ->get();


         $new = $arrayPosibles->filter(function($persona) use($arrayIncidencias) 
            {
                $sw=1;
                foreach ($arrayIncidencias as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            $sw=0;
                        }
                      
                    }
                return $sw;
            }); 

        return $new;
    }
}