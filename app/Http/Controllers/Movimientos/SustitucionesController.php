<?php
namespace App\Http\Controllers\Movimientos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Persona;
use App\Externo;
use App\Sustitucion;
use App\Incidencia;
use Carbon\Carbon;




class SustitucionesController extends Controller
{
     public function getIndex()
    {
        $arraySustituciones = Sustitucion::join('personas', 'sustituciones.idpersona','=', 'personas.id')
        ->join('view_externos', 'sustituciones.idpersona_externa','=', 'view_externos.id')
        ->select('sustituciones.*', 'personas.nombre as sustituido','view_externos.nombre as sustituto')->orderBy('sustituciones.desde','desc')
        ->orderBy('sustituciones.id')->get();

        foreach ($arraySustituciones as $key => $sust) {
        	if ($sust->hasta)
        	    $sust->dias= ($sust->hasta->diffInDays($sust->desde))+1;
        	else
        		if (Carbon::now() > $sust->desde)
        			$sust->dias = (Carbon::now()->diffInDays($sust->desde))+1;
        		else
        			$sust->dias = "1";
        }

       

        return view('movimientos.sustituciones.index',compact('arraySustituciones'));
    

    }

 	public function getEdit($id)
    {
    	$arraySustituciones = Sustitucion::join('personas', 'sustituciones.idpersona','=', 'personas.id')
        ->join('view_externos', 'sustituciones.idpersona_externa','=', 'view_externos.id')
        ->select('sustituciones.*', 'personas.nombre as sustituido','view_externos.nombre as sustituto')->orderBy('sustituciones.desde','desc')
        ->orderBy('sustituciones.id')->get();

        $sustitucione=Sustitucion::find($id);

        $fhasta=null;
                
        return view('movimientos.sustituciones.edit',compact(['sustitucione','arraySustituciones','fhasta']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$sustitucion = Sustitucion::find($id);
    	
    	$sustitucion->hasta=$request->input('hasta');
    	
      	$sustitucion->save();

    	Session::flash('message','El Sustitucion  se ha modificado correctamente!');
    	
 		return redirect('sustituciones');       
    } 

     public function getInsertar(Request $request)
    {

        $arraySustituciones = Sustitucion::join('personas', 'sustituciones.idpersona','=', 'personas.id')
        ->join('view_externos', 'sustituciones.idpersona_externa','=', 'view_externos.id')
        ->select('sustituciones.*', 'personas.nombre as sustituido','view_externos.nombre as sustituto')->orderBy('sustituciones.desde','desc')
        ->orderBy('sustituciones.id')->get();

        $fdesde = Carbon::createFromFormat('Y-m-d', $request->input('fdesde')) ;
        $fdesde->hour = 00;
        $fdesde->minute = 00;
        $fdesde->second = 00;

        $arrayPersonas= $this->posiblesSustituibles($fdesde,$arraySustituciones);
        /* Persona::select('id','nombre')->where('activo','=','1')->orderBy('nombre')->get(); */
        $arrayExternos=$this->posiblesSustitutos($fdesde,$arraySustituciones);

		return view('movimientos.sustituciones.create',compact(['arraySustituciones','arrayPersonas','arrayExternos','fdesde']));

    }


    public function postInsertar(Request $request)
    {
        $sustitucion = new Sustitucion;
        
        $sustitucion->idpersona=$request->input('idpersona');
        $sustitucion->idpersona_externa=$request->input('idpersona_externa');
		$sustitucion->desde=$request->input('desde');
		$sustitucion->hasta=$request->input('hasta');
        $sustitucion->save();
        Session::flash('message','La Sustitucion ha sido almacenada corectamente!');
        
        return redirect('sustituciones');
        
    }
    
	public function postDelete($id)
    {
    	$sustitucion = Sustitucion::find($id);
    	
    	$sustitucion->delete();
        Session::flash('message','La Sustitucion ha sido eliminada!');

    	return redirect('sustituciones');
        
    }


    public static function posiblesSustituibles(Carbon $fecha,$arraySustituciones)
    {
        /* Personas que no son externos, son chamanes o forman parte de algun equipo y que tengan alguna incidencia motivo de la sustitución durante la fechas indicada, ojo contemplamos incidencias tambien de externos */
        $arrayPosibles= Incidencia::select('incidencias.idpersona as id','personas.nombre','incidencias.hasta')
        ->join('personas','incidencias.idpersona','=', 'personas.id')
        ->where([['incidencias.desde','<=',$fecha->format('Y-m-d')],['incidencias.hasta','=',null]])
        ->orwhere([['incidencias.desde','<=',$fecha->format('Y-m-d')],['incidencias.hasta','>=',$fecha->format('Y-m-d')]])
        ->orderBy('personas.nombre')
        ->get();

        /* eliminamos los que ya estén siendo sustituidos */
       $new = $arrayPosibles->filter(function($persona) use($arraySustituciones, $fecha) 
            {
                $sw=1;
                foreach ($arraySustituciones as $persona2)
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
        
            



        return $new;
    }
    public function posiblesSustitutos(Carbon $fecha, $arraySustituciones)
    {
        /* Este select elimina los externos del cursor de personal 

        SELECT personas.id, personas.nombre FROM `personas` LEFT Join persona_externos on (personas.id = persona_externos.idpersona ) where persona_externos.id is null

        */
        /* personal externo ordenado por tipo de contrato que esté disponible, es decir que no figure en incidencias y ni esté haciendo una sustitución en la fecha indicada */
        $arrayPosibles= Externo::select('persona_externos.id','personas.nombre','persona_externos.hasta','categorias_externos.descripcion')
        ->join('personas','persona_externos.idpersona','=', 'personas.id')
        ->join('categorias_externos','persona_externos.idcategoria','=','categorias_externos.id')
        ->where([['persona_externos.desde','<=',$fecha->format('Y-m-d')],['persona_externos.hasta','=',null]])
        ->orwhere([['persona_externos.desde','<=',$fecha->format('Y-m-d')],['persona_externos.hasta','>=',$fecha->format('Y-m-d')]])
        ->orderBy('personas.nombre')
        ->get();

        /* tenemos disponibles en externos y buscamos los externos que ya estan realizando sustituciones para quitarlos*/

        $new = $arrayPosibles->filter(function($persona) use($arraySustituciones, $fecha) 
            {
                $sw=1;
                foreach ($arraySustituciones as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona_externa) {
                            
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
        
            



        return $new;
    }
}