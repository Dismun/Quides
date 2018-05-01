<?php
namespace App\Http\Controllers\Maestros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Tipoincidencia;
use DB;

class TipoincidenciasController extends Controller
{
     public function getIndex()
    {
        $arrayTipoincidencias = Tipoincidencia::orderBy('descripcion','asc')->get();
        return view('maestros.tipoincidencias.index',compact('arrayTipoincidencias'));
    }


     public function getCreate()
    {
        return view('maestros.tipoincidencias.create');
    }
     public function getShow($id)
    {	
    	$tipoincidencia = Tipoincidencia::find($id);
    	
        return view('maestros.tipoincidencias.show',compact('tipoincidencia'));
    }
     public function getEdit($id)
    {
        $tipoincidencia=Tipoincidencia::find($id);
        return view('maestros.tipoincidencias.edit',compact('tipoincidencia'));
    }

     public function postCreate(Request $request)
    {
    	$tipoincidencia = new Tipoincidencia;
    	$tipoincidencia->descripcion=$request->input('descripcion');
    	$tipoincidencia->codigo=$request->input('codigo');
    	$tipoincidencia->color=$request->input('color');
    	
    	
    	
       
    	$tipoincidencia->save();
        
    	Session::flash('message','El tipo de incidencia '.$tipoincidencia->descripcion.' se ha guardado correctamente!');
		return view('maestros.tipoincidencias.show',compact('tipoincidencia'));
     }   

     public function postUpdate(Request $request,$id)
    {
    	$tipoincidencia = Tipoincidencia::find($id);
    	$tipoincidencia->descripcion=$request->input('descripcion');
    	$tipoincidencia->codigo=$request->input('codigo');
    	$tipoincidencia->color=$request->input('color');
    	
    	
    	
        //obtenemos el campo imagen definido en el formulario
      
    	$tipoincidencia->save();
    	Session::flash('message','El tipo de incidencia '.$tipoincidencia->descripcion.' se ha modificado correctamente!');
    	return view('maestros.tipoincidencias.show',compact('tipoincidencia'));
       
    }

    

	public function postDelete($id)
    {
    	$tipoincidencia = Tipoincidencia::find($id);
    	
    	$tipoincidencia->delete();
        Session::flash('message','El tipoi de incidencia '.$tipoincidencia->descripcion.' ha sido eliminado!');

    	

    	return redirect('tipoincidencias');
        
    }
}