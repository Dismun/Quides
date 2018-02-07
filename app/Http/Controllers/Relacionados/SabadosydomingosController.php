<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Punto;
use App\Turno;
use App\Sabadosydomingo;




class SabadosydomingosController extends Controller
{
     public function getIndex()
    {
        $arraySabadosydomingos = Sabadosydomingo::join('turnos', 'sabadosydomingos.idturno', '=', 'turnos.id')
        ->join('puntos', 'sabadosydomingos.idpunto','=', 'puntos.id')
        ->select('sabadosydomingos.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp')->orderBy('sabadosydomingos.desde','desc')
        ->orderBy('sabadosydomingos.id')->get();

        return view('relacionados.sabadosydomingos.index',compact('arraySabadosydomingos'));
    

    }

 	public function getEdit($id)
    {
    	$arraySabadosydomingos = Sabadosydomingo::join('turnos', 'sabadosydomingos.idturno', '=', 'turnos.id')
        ->join('puntos', 'sabadosydomingos.idpunto','=', 'puntos.id')
        ->select('sabadosydomingos.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp')->orderBy('sabadosydomingos.desde','desc')
        ->orderBy('sabadosydomingos.id')->get();

        $sabadosydomingoe=Sabadosydomingo::find($id);
        $fhasta=null;

                
        return view('relacionados.sabadosydomingos.edit',compact(['sabadosydomingoe','arraySabadosydomingos','fhasta']));
    }

    public function postUpdate(Request $request,$id)
    {
    	$sabadosydomingo = Sabadosydomingo::find($id);
    	
    	$sabadosydomingo->hasta=$request->input('hasta');
    	
      	$sabadosydomingo->save();

    	Session::flash('message','El Sabadosydomingo se ha modificado correctamente!');
    	
 		return redirect('sabadosydomingos');       
    } 

     public function getInsertar(Request $request)
    {
        $arrayTurnos=Turno::orderBy('descripcion')->get();
        $arrayPuntos=Punto::orderBy('descripcion')->get();
        $fdesde=$request->input('fdesde');
        $arraySabadosydomingos = Sabadosydomingo::join('turnos', 'sabadosydomingos.idturno', '=', 'turnos.id')
        ->join('puntos', 'sabadosydomingos.idpunto','=', 'puntos.id')
        ->select('sabadosydomingos.*', 'turnos.descripcion as desct', 'puntos.descripcion as descp')->orderBy('sabadosydomingos.desde','desc')
        ->orderBy('sabadosydomingos.id')->get();



		return view('relacionados.sabadosydomingos.create',compact(['arraySabadosydomingos','arrayTurnos','arrayPuntos','fdesde']));

    }


    public function postInsertar(Request $request)
    {
        $sabadosydomingo = new Sabadosydomingo;
        
        $sabadosydomingo->idturno=$request->input('idturno');
		$sabadosydomingo->idpunto=$request->input('idpunto');
		$sabadosydomingo->desde=$request->input('desde');
		$sabadosydomingo->hasta=$request->input('hasta');
		if ($request->has('sabados'))
    		$sabadosydomingo->sabados=1;
    	else
    		$sabadosydomingo->sabados=0;



		if ($request->has('domingos'))
    		$sabadosydomingo->domingos=1;
    	else
    		$sabadosydomingo->domingos=0;

        $sabadosydomingo->save();

        Session::flash('message','El Sabadosydomingo ha sido almacenado corectamente!');
        
        return redirect('sabadosydomingos');
        
    }
    
	public function postDelete($id)
    {
    	$sabadosydomingo = Sabadosydomingo::find($id);
    	
    	$sabadosydomingo->delete();
        Session::flash('message','El Sabadosydomingo ha sido eliminado!');

    	return redirect('sabadosydomingos');
        
    }
}