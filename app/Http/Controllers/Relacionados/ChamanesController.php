<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Punto;
use App\Turno;
use App\Persona;
use App\Chaman;
use App\Externo;
use App\Compoequipo;
use Carbon\Carbon;




class ChamanesController extends Controller
{
     public function getIndex()
    {
        $arrayChamanes = Chaman::join('turnos', 'chamanes.idturno', '=', 'turnos.id')
        ->join('puntos', 'chamanes.idpunto','=', 'puntos.id')
        ->join('personas', 'chamanes.idpersona','=', 'personas.id')
        ->select('chamanes.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp', 'personas.nombre')->orderBy('chamanes.desde','desc')
        ->orderBy('chamanes.id')->get();

        return view('relacionados.chamanes.index',compact('arrayChamanes'));
    

    }

 	public function getEdit($id)
    {
    	$arrayChamanes = Chaman::join('turnos', 'chamanes.idturno', '=', 'turnos.id')
        ->join('puntos', 'chamanes.idpunto','=', 'puntos.id')
        ->join('personas', 'chamanes.idpersona','=', 'personas.id')
        ->select('chamanes.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp', 'personas.nombre')->orderBy('chamanes.desde','desc')
        ->orderBy('chamanes.id')->get();

        $chamane=Chaman::find($id);

        $fhasta=null;


                
        return view('relacionados.chamanes.edit',compact(['chamane','arrayChamanes','fhasta']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$chaman = Chaman::find($id);
    	
    	$chaman->hasta=$request->input('hasta');
    	
      	$chaman->save();

    	Session::flash('message','El Chaman '.$chaman->nombre.' se ha modificado correctamente!');
    	
 		return redirect('chamanes');       
    } 

     public function getInsertar(Request $request)
    {
        $arrayPersonas=Persona::select('id','nombre')->where('activo','=','1')->orderBy('nombre')->get();
        $arrayTurnos=Turno::where('activo','=','1')->orderBy('descripcion')->get();
        $arrayPuntos=Punto::orderBy('descripcion')->get();
        $arrayExternos=Externo::select('idpersona','desde','hasta')->get();
        $arrayCompoequipos=Compoequipo::select('idpersona','desde','hasta')->get();
        $fdesde=$request->input('fdesde');
        $arrayChamanes = Chaman::join('turnos', 'chamanes.idturno', '=', 'turnos.id')
        ->join('puntos', 'chamanes.idpunto','=', 'puntos.id')
        ->join('personas', 'chamanes.idpersona','=', 'personas.id')
        ->select('chamanes.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp', 'personas.nombre')->orderBy('chamanes.desde','desc')
        ->orderBy('chamanes.id')->get();

        $fhasta=null;

        foreach ($arrayPersonas as $persona)
        {
            $persona->fhasta = null;
        }


           $new = $arrayPersonas->filter(function($persona) use($arrayExternos, $fdesde) 
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
                                else {
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
                                if (($persona2->desde->format('Y-m-d') <= $fdesde) and ($persona2->hasta->format('Y-m-d') >= $fdesde)) {
                                    $sw=0;
                                }
                                else {
                                     // $persona->fhasta =$persona2->desde->subDay(1)->format('Y-m-d');
                                }
                            }
                        }     
                    }              
                return $sw;
                    
            });

        $arrayPersonas = $new ;

        

        // dd($arrayPersonas);



		return view('relacionados.chamanes.create',compact(['arrayChamanes','arrayPersonas','arrayTurnos','arrayPuntos','fdesde']));

    }


    public function postInsertar(Request $request)
    {
        $chaman = new Chaman;
        
        $chaman->idturno=$request->input('idturno');
        $chaman->idpersona=$request->input('idpersona');
		$chaman->idpunto=$request->input('idpunto');
		$chaman->desde=$request->input('desde');
		$chaman->hasta=$request->input('hasta');
        $chaman->save();
        Session::flash('message','El Chaman '.$chaman->nombre.' ha sido almacenado corectamente!');
        
        return redirect('chamanes');
        
    }
    
	public function postDelete($id)
    {
    	$chaman = Chaman::find($id);
    	
    	$chaman->delete();
        Session::flash('message','El Chaman '.$chaman->nombre.' ha sido eliminado!');

    	return redirect('chamanes');
        
    }
}