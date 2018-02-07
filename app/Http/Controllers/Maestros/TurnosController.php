<?php
namespace App\Http\Controllers\Maestros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Turno;
use DB;

class TurnosController extends Controller
{
     public function getIndex()
    {
        $arrayTurnos = Turno::orderBy('activo','desc')
            ->orderBy('desde','asc')
            ->orderBy('hasta','asc')
            ->get();
        return view('maestros.turnos.index',compact('arrayTurnos'));
    }


     public function getCreate()
    {
        return view('maestros.turnos.create');
    }

     public function getShow($id)
    {	
    	$turno=Turno::find($id);
    	
        return view('maestros.turnos.show',compact('turno'));
    }
     public function getEdit($id)
    {
        $turno=Turno::find($id);
        
        return view('maestros.turnos.edit',compact('turno'));
    }

     public function postCreate(Request $request)
    {
    	$turno = new Turno;
    	$turno->descripcion=$request->input('descripcion');
    	$turno->codigo=$request->input('codigo');
    	$turno->desde=$request->input('desde');
    	$turno->hasta=$request->input('hasta');
        $turno->horas=$request->input('horas');

    	if ($request->has('activo'))
    		$turno->activo=1;
    	else
    		$turno->activo=0;

        //obtenemos el campo imagen definido en el formulario
       
    	$turno->save();
        
    	Session::flash('message','El turno '.$turno->descripcion.' se ha guardado correctamente!');
		return view('maestros.turnos.show',compact('turno'));
     }   

     public function postUpdate(Request $request,$id)
    {
    	$turno = Turno::find($id);
    	$turno->descripcion=$request->input('descripcion');
    	$turno->codigo=$request->input('codigo');
    	$turno->desde=$request->input('desde');
    	$turno->hasta=$request->input('hasta');
        $turno->horas=$request->input('horas');
    	if ($request->has('activo'))
    		$turno->activo=1;
    	else
    		$turno->activo=0;
    	
        //obtenemos el campo imagen definido en el formulario
      
    	$turno->save();
    	Session::flash('message','El turno '.$turno->descripcion.' se ha modificado correctamente!');
    	return view('maestros.turnos.show',compact('turno'));
       
    }

    

	public function postDelete($id)
    {
    	$turno = Turno::find($id);
    	
    	$turno->delete();
        Session::flash('message','El turno '.$turno->descripcion.' ha sido eliminado!');

    	

    	return redirect('turnos');
        
    }
}