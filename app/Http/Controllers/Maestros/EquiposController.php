<?php
namespace App\Http\Controllers\Maestros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Equipo;
use DB;

class EquiposController extends Controller
{
     public function getIndex()
    {
        $arrayEquipos = Equipo::orderBy('orden','asc')->get();
        return view('maestros.equipos.index',compact('arrayEquipos'));
    }


     public function getCreate()
    {
        return view('maestros.equipos.create');
    }
     public function getShow($id)
    {	
    	$equipo = Equipo::find($id);
    	
        return view('maestros.equipos.show',compact('equipo'));
    }
     public function getEdit($id)
    {
        $equipo=Equipo::find($id);
        return view('maestros.equipos.edit',compact('equipo'));
    }

     public function postCreate(Request $request)
    {
    	$equipo = new Equipo;
    	$equipo->descripcion=$request->input('descripcion');
    	$equipo->codigo=$request->input('codigo');
    	$equipo->color=$request->input('color');
    	$equipo->orden=$request->input('orden');
    	
    	
       
    	$equipo->save();
        
    	Session::flash('message','El equipo '.$equipo->descripcion.' se ha guardado correctamente!');
		return view('maestros.equipos.show',compact('equipo'));
     }   

     public function postUpdate(Request $request,$id)
    {
    	$equipo = Equipo::find($id);
    	$equipo->descripcion=$request->input('descripcion');
    	$equipo->codigo=$request->input('codigo');
    	$equipo->color=$request->input('color');
    	$equipo->orden=$request->input('orden');
    	
    	
        //obtenemos el campo imagen definido en el formulario
      
    	$equipo->save();
    	Session::flash('message','El equipo '.$equipo->descripcion.' se ha modificado correctamente!');
    	return view('maestros.equipos.show',compact('equipo'));
       
    }

    

	public function postDelete($id)
    {
    	$equipo = Equipo::find($id);
    	
    	$equipo->delete();
        Session::flash('message','El equipo '.$equipo->descripcion.' ha sido eliminado!');

    	

    	return redirect('equipos');
        
    }
}