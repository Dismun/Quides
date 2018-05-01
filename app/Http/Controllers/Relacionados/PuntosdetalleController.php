<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Punto;
use App\Turno;
use App\Puntosdetalle;




class PuntosdetalleController extends Controller
{
     public function getIndex()
    {
        $arrayPuntosdetalles = Puntosdetalle::join('turnos', 'puntos_detalle.idturno', '=', 'turnos.id')
        ->join('puntos', 'puntos_detalle.idpunto','=', 'puntos.id')
        ->join('niveles', 'puntos.idnivel','=', 'niveles.id')
        ->select('puntos_detalle.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp', 'niveles.color')
        ->orderBy('puntos_detalle.id')->get();

        return view('relacionados.puntosdetalles.index',compact('arrayPuntosdetalles'));
    

    }

 	public function getEdit($id)
    {
    	$arrayPuntosdetalles = Puntosdetalle::join('turnos', 'puntos_detalle.idturno', '=', 'turnos.id')
        ->join('puntos', 'puntos_detalle.idpunto','=', 'puntos.id')
        ->select('puntos_detalle.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp')
        ->orderBy('puntos_detalle.id')->get();

        $puntosdetallee=Puntosdetalle::find($id);
        

                
        return view('relacionados.puntosdetalles.edit',compact(['puntosdetallee','arrayPuntosdetalles']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$puntosdetalle = Puntosdetalle::find($id);
    	
    	if ($request->has('lunes'))
    		$puntosdetalle->lunes=1;
    	else
    		$puntosdetalle->lunes=0;

    	if ($request->has('martes'))
    		$puntosdetalle->martes=1;
    	else
    		$puntosdetalle->martes=0;

    	if ($request->has('miercoles'))
    		$puntosdetalle->miercoles=1;
    	else
    		$puntosdetalle->miercoles=0;

    	if ($request->has('jueves'))
    		$puntosdetalle->jueves=1;
    	else
    		$puntosdetalle->jueves=0;

    	if ($request->has('viernes'))
    		$puntosdetalle->viernes=1;
    	else
    		$puntosdetalle->viernes=0;

		if ($request->has('sabado'))
    		$puntosdetalle->sabado=1;
    	else
    		$puntosdetalle->sabado=0;

		if ($request->has('domingo'))
    		$puntosdetalle->domingo=1;
    	else
    		$puntosdetalle->domingo=0;

    	if ($request->has('festivo'))
    		$puntosdetalle->festivo=1;
    	else
    		$puntosdetalle->festivo=0;
    	
      	$puntosdetalle->save();

    	Session::flash('message','El Puntosdetalle se ha modificado correctamente!');
    	
 		return redirect('puntos_detalle');       
    } 

     public function getInsertar(Request $request)
    {
        $arrayTurnos=Turno::orderBy('descripcion')->get();
        $arrayPuntos=Punto::orderBy('descripcion')->get();
        
        $arrayPuntosdetalles = Puntosdetalle::join('turnos', 'puntos_detalle.idturno', '=', 'turnos.id')
        ->join('puntos', 'puntos_detalle.idpunto','=', 'puntos.id')
        ->select('puntos_detalle.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp')
        ->orderBy('puntos_detalle.id')->get();



		return view('relacionados.puntosdetalles.create',compact(['arrayPuntosdetalles','arrayTurnos','arrayPuntos']));

    }


    public function postInsertar(Request $request)
    {
        $puntosdetalle = new Puntosdetalle;
        
        $puntosdetalle->idturno=$request->input('idturno');
		$puntosdetalle->idpunto=$request->input('idpunto');
		if ($request->has('lunes'))
    		$puntosdetalle->lunes=1;
    	else
    		$puntosdetalle->lunes=0;

    	if ($request->has('martes'))
    		$puntosdetalle->martes=1;
    	else
    		$puntosdetalle->martes=0;

    	if ($request->has('miercoles'))
    		$puntosdetalle->miercoles=1;
    	else
    		$puntosdetalle->miercoles=0;

    	if ($request->has('jueves'))
    		$puntosdetalle->jueves=1;
    	else
    		$puntosdetalle->jueves=0;

    	if ($request->has('viernes'))
    		$puntosdetalle->viernes=1;
    	else
    		$puntosdetalle->viernes=0;

		if ($request->has('sabado'))
    		$puntosdetalle->sabado=1;
    	else
    		$puntosdetalle->sabado=0;

		if ($request->has('domingo'))
    		$puntosdetalle->domingo=1;
    	else
    		$puntosdetalle->domingo=0;

    	if ($request->has('festivo'))
    		$puntosdetalle->festivo=1;
    	else
    		$puntosdetalle->festivo=0;

        $puntosdetalle->save();

        Session::flash('message','El Puntosdetalle ha sido almacenado corectamente!');
        
        return redirect('puntos_detalle');
        
    }
    
	public function postDelete($id)
    {
    	$puntosdetalle = Puntosdetalle::find($id);
    	
    	$puntosdetalle->delete();
        Session::flash('message','El Puntosdetalle ha sido eliminado!');

    	return redirect('puntos_detalle');
        
    }
}