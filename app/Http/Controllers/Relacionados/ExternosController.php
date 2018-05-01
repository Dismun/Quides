<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Externo;
use App\Categoria;
use App\Persona;
use App\Compoequipo;
use App\Chaman;




class ExternosController extends Controller
{
     public function getIndex()
    {
        $arrayExternos = Externo::join('personas', 'persona_externos.idpersona', '=', 'personas.id')
        ->join('categorias_externos', 'persona_externos.idcategoria','=', 'categorias_externos.id')
        ->select('persona_externos.*', 'personas.nombre', 'categorias_externos.descripcion')
        ->orderBy('persona_externos.idcategoria','asc')
        ->orderBy('persona_externos.desde', 'asc')->get();

        return view('relacionados.externos.index',compact('arrayExternos'));
    

    }

 	public function getEdit($id)
    {
    	$arrayExternos = Externo::join('personas', 'persona_externos.idpersona', '=', 'personas.id')
        ->join('categorias_externos', 'persona_externos.idcategoria','=', 'categorias_externos.id')
        ->select('persona_externos.*', 'personas.nombre', 'categorias_externos.descripcion')->orderBy('persona_externos.idcategoria','asc')
        ->orderBy('persona_externos.desde', 'asc')->get();


        $externoe=Externo::find($id);

        return view('relacionados.externos.edit',compact(['externoe','arrayExternos']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$externo = Externo::find($id);
    	
    	$externo->hasta=$request->input('hasta');
    	
      	$externo->save();
    	Session::flash('message','El registro se ha modificado correctamente!');
    	// return view('relacionados.externo.show',compact('externo'));
 
		return redirect('externos');
       
    } 

     public function getInsertar(Request $request)
    {
        $arrayExternos = Externo::join('personas', 'persona_externos.idpersona', '=', 'personas.id')
        ->join('categorias_externos', 'persona_externos.idcategoria','=', 'categorias_externos.id')
        ->select('persona_externos.*', 'personas.nombre', 'categorias_externos.descripcion')->orderBy('persona_externos.idcategoria','asc')
        ->orderBy('persona_externos.desde', 'asc')->get();

        $fdesde=$request->input('fdesde');
        $arrayPersonas=Persona::select('id','nombre')->where('activo','=','1')->orderBy('nombre')->get();
        $arrayCategorias=Categoria::orderBy('descripcion')->get();
        $arrayNo=Compoequipo::select('idpersona','desde','hasta')->get();

        foreach ($arrayPersonas as $persona)
        {
            $persona->fhasta = null;
        }
       
            $new = $arrayPersonas->filter(function($persona) use($arrayNo, $fdesde) // es por que arraynno no es visible desntro de la función....
            {
                $sw=1;
                foreach ($arrayNo as $persona2)
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
        

       // dd($new);

        $arrayPersonas = $new ;
        
        $arrayNo=Chaman::select('idpersona','desde','hasta')->get();
        
        $new = $arrayPersonas->filter(function($persona) use($arrayNo, $fdesde) // es por que arraynno no es visible desntro de la función....
            {
                $sw=1;
                foreach ($arrayNo as $persona2)
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
                                if (($persona2->desde->format('Y-m-d') <= $fdesde) and ($persona2->hasta->format('Y-m-d') >= $fdesde)) {
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

		return view('relacionados.externos.create',compact(['arrayExternos','arrayPersonas','arrayCategorias','fdesde']));

    }


    public function postInsertar(Request $request)
    {
        $externo = new Externo;
        
        $externo->idcategoria=$request->input('idcategoria');
        $externo->idpersona=$request->input('idpersona');
		$externo->desde=$request->input('desde');
		$externo->hasta=$request->input('hasta');
        $externo->lugar_trabajo=$request->input('lugar_trabajo');
        $externo->predisposicion=$request->input('predisposicion');

        $externo->save();
        Session::flash('message','El registro ha sido almacenado corectamente!');
        
        return redirect('externos');
        
    }
    
	public function postDelete($id)
    {
    	$externo = Externo::find($id);
    	
    	$externo->delete();
        Session::flash('message','El registro '.$externo->nombre.' ha sido eliminado!');

    	return redirect('externos');
        
    }
}