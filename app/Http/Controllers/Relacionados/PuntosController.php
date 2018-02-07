<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Punto;
use App\Centro;
use App\Nivel;



class PuntosController extends Controller
{
     public function getIndex()
    {
        $arrayPuntos = Punto::join('centros', 'puntos.idcentro', '=', 'centros.id')
        ->join('niveles', 'puntos.idnivel','=', 'niveles.id')
        ->select('puntos.*', 'centros.descripcion as descc', 'niveles.descripcion as descn','niveles.color')
        ->orderBy('puntos.prioridad','asc')
        ->get();

        return view('relacionados.puntos.index',compact('arrayPuntos'));
    

    }

 	Public function getSubir($id)
     {
        $puntos = Punto::find($id);
        $puntos->prioridad=($puntos->prioridad - 15) ;
        $puntos->save();
        
        $arrayPuntos = Punto::join('centros', 'puntos.idcentro', '=', 'centros.id')
        ->join('niveles', 'puntos.idnivel','=', 'niveles.id')
        ->select('puntos.*', 'centros.descripcion as descc', 'niveles.descripcion as descn','niveles.color')->orderBy('puntos.prioridad','asc')
        ->get();
        $intervalo=10;

        foreach( $arrayPuntos as $key => $puntos )
        {
            $puntos->prioridad=$intervalo;

            $intervalo=$intervalo + 10;

            $puntos->save();
        }


        return redirect('puntos');

    }
     public function getBajar($id)
    {
        $puntos = Punto::find($id);
        $puntos->prioridad=($puntos->prioridad + 15) ;
        $puntos->save();
        
        $arrayPuntos = Punto::join('centros', 'puntos.idcentro', '=', 'centros.id')
        ->join('niveles', 'puntos.idnivel','=', 'niveles.id')
        ->select('puntos.*', 'centros.descripcion as descc', 'niveles.descripcion as descn','niveles.color')->orderBy('puntos.prioridad','asc')
        ->get();
        $intervalo=10;

        foreach( $arrayPuntos as $key => $puntos )
        {
            $puntos->prioridad=$intervalo;

            $intervalo=$intervalo + 10;
            
            $puntos->save();
        }


        return redirect('puntos');

    }

    public function getInsertar($id)
    {
    	$puntoe = Punto::find($id);
    	$punto = new Punto;
    	$punto->idnivel = $puntoe->idnivel;
    	$punto->idcentro = $puntoe->idcentro;
    	$punto->codigo =$puntoe->codigo;
    	$punto->prioridad = $puntoe->prioridad - 5;
    	$punto->descripcion = $puntoe->descripcion;
    	$punto->guardia = $puntoe->guardia;
    	$punto->save();
        $arrayCentros = Centro::orderBy('descripcion')->get();
        $arrayNiveles = Nivel::orderBy('descripcion')->get();
        $arrayPuntos = Punto::join('centros', 'puntos.idcentro', '=', 'centros.id')
        ->join('niveles', 'puntos.idnivel','=', 'niveles.id')
        ->select('puntos.*', 'centros.descripcion as descc', 'niveles.descripcion as descn','niveles.color')->orderBy('puntos.prioridad','asc')
        ->get();

        $idposterior = $id;
        

		return view('relacionados.puntos.edit',compact(['arrayPuntos','arrayNiveles','arrayCentros','puntoe']));

    }


    public function postInsertar(Request $request,$id)
    {
        $punto = Punto::find($id);
        $punto->idnivel=$request->input('idnivel');
        $punto->idcentro=$request->input('idcentro');
		$punto->descripcion=$request->input('descripcion');
		$punto->codigo=$request->input('codigo');
		$punto->guardia=$request->has('guardia');
        $punto->save();
        Session::flash('message','El Punto '.$punto->descripcion.' ha sido almacenado corectamente!');
        
        return redirect('puntos');
        
    }
 
	public function postDelete($id)
    {
    	$punto = Punto::find($id);
    	
    	$punto->delete();
        Session::flash('message','El Punto '.$punto->nombre.' ha sido eliminado!');

    	return redirect('puntos');
        
    }
}