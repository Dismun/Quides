<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Compoequipo;
use App\Equipo;
use App\Persona;
use App\Externo;
use App\Chaman;




class CompoequiposController extends Controller
{
     public function getIndex()
    {
        $arrayCompoequipos = Compoequipo::join('personas', 'equipos_composicion.idpersona', '=', 'personas.id')
        ->join('equipos', 'equipos_composicion.idequipo','=', 'equipos.id')
        ->select('equipos_composicion.*', 'personas.nombre', 'equipos.descripcion','equipos.color')->orderBy('equipos_composicion.idequipo','asc')
        ->orderBy('equipos_composicion.id', 'asc')->get();

        return view('relacionados.compoequipos.index',compact('arrayCompoequipos'));
    

    }
    public function getEdit($id)
    {
    	$arrayCompoequipos = Compoequipo::join('personas', 'equipos_composicion.idpersona', '=', 'personas.id')
        ->join('equipos', 'equipos_composicion.idequipo','=', 'equipos.id')
        ->select('equipos_composicion.*', 'personas.nombre', 'equipos.descripcion','equipos.color')->orderBy('equipos_composicion.idequipo','asc')
        ->orderBy('equipos_composicion.desde', 'asc')->get();

        $compoequipoe=Compoequipo::find($id);

        return view('relacionados.compoequipos.edit',compact(['compoequipoe','arrayCompoequipos']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$compoequipo = Compoequipo::find($id);
    	
    	$compoequipo->hasta=$request->input('hasta');
    	
      	$compoequipo->save();
    	Session::flash('message','El regi Aoequipo.show',compact('compoequipo'));
 
		return redirect('compoequipos'); 
       
    } 



     public function getInsertar(Request $request)
    {
        $arrayPersonas=Persona::select('id','nombre')->where('activo','=','1')->orderBy('nombre')->get();
        $arrayEquipos=Equipo::orderBy('descripcion')->get();
        $arrayExternos=Externo::orderBy('idpersona')->select('idpersona','desde','hasta')->get();
        $arrayChamanes=Chaman::select('idpersona','desde','hasta')->orderBy('idpersona')->get();
        $fdesde=$request->input('fdesde');
        $arrayCompoequipos = Compoequipo::join('personas', 'equipos_composicion.idpersona', '=', 'personas.id')
        ->join('equipos', 'equipos_composicion.idequipo','=', 'equipos.id')
        ->select('equipos_composicion.*', 'personas.nombre', 'equipos.descripcion','equipos.color')->orderBy('equipos_composicion.idequipo','asc')
        ->orderBy('equipos_composicion.desde', 'asc')->get();

        
       foreach ($arrayPersonas as $persona)
        {
            $persona->fhasta = null;
        }
    
            $new = $arrayPersonas->filter(function($persona) use($arrayChamanes, $fdesde) 
            {
                $sw=1;
                foreach ($arrayChamanes as $persona2)
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
        
       
        
        $new = $arrayPersonas->filter(function($persona) use($arrayExternos, $fdesde) // es por que arraynno no es visible desntro de la función....
            {
                $sw=1;
                foreach ($arrayExternos as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            if ((is_null($persona2->hasta)) and ($persona2->desde->format('Y-m-d') <= $fdesde)) {
                                $sw=0;
                            }
                            else {
                                if  (($persona2->desde->format('Y-m-d') <= $fdesde) and ($persona2->hasta->format('Y-m-d') >= $fdesde)) {
                                	$sw=0;
                                }
                                else
                                {
                                	$persona->fhasta =$persona2->desde->subDay(1)->format('Y-m-d');
                                }
                            }  
                        }
                    }
                return $sw;
            });

        $arrayPersonas = $new ;
      
        $new = $arrayPersonas->filter(function($persona) use($arrayCompoequipos, $fdesde) // es por que arraynno no es visible desntro de la función....
            {
                $sw=1;
                foreach ($arrayCompoequipos as $persona2)
                    {
                        if ($persona->id == $persona2->idpersona) {
                            if ((is_null($persona2->hasta)) and ($persona2->desde->format('Y-m-d') <= $fdesde)) {
                                $sw=0;
                            }
                            else {
                                if (($persona2->desde->format('Y-m-d') <= $fdesde) and ($persona2->hasta->format('Y-m-d') >= $fdesde)) {
                                	$sw=0;
                                }
                                else
                                {
                                	$persona->fhasta =$persona2->desde->subDay(1)->format('Y-m-d');
                                }
                            }
                        }     
                    }              
                return $sw;
                    
            });

        $arrayPersonas = $new ;
	

		return view('relacionados.compoequipos.create',compact(['arrayCompoequipos','arrayPersonas','arrayEquipos','fdesde']));

    }

    


    public function postInsertar(Request $request)
    {
        $compoequipo = new Compoequipo;
        
        $compoequipo->idequipo=$request->input('idequipo');
        $compoequipo->idpersona=$request->input('idpersona');
		$compoequipo->desde=$request->input('desde');
		$compoequipo->hasta=$request->input('hasta');
        $compoequipo->save();
        Session::flash('message','El registro ha sido almacenado corectamente!');
        
        return redirect('compoequipos');
        
    }
    
	public function postDelete($id)
    {
    	$compoequipo = Compoequipo::find($id);
    	
    	$compoequipo->delete();
        Session::flash('message','El registro '.$compoequipo->nombre.' ha sido eliminado!');

    	return redirect('compoequipos');
        
    }
}