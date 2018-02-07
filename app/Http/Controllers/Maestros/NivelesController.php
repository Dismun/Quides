<?php
namespace App\Http\Controllers\Maestros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Nivel;
use DB;

class NivelesController extends Controller
{
     public function getIndex()
    {
        $arrayNiveles = Nivel::orderBy('nivel','asc')->get();
        return view('maestros.niveles.index',compact('arrayNiveles'));
    }


     public function getCreate()
    {
        return view('maestros.niveles.create');
    }
     public function getShow($id)
    {	
    	$nivel = Nivel::find($id);
    	
        return view('maestros.niveles.show',compact('nivel'));
    }
     public function getEdit($id)
    {
        $nivel=Nivel::find($id);
        return view('maestros.niveles.edit',compact('nivel'));
    }

     public function postCreate(Request $request)
    {
    	$nivel = new Nivel;
    	$nivel->descripcion=$request->input('descripcion');
    	$nivel->codigo=$request->input('codigo');
    	$nivel->color=$request->input('color');
    	$nivel->nivel=$request->input('nivel');
    	
       
    	$nivel->save();
        
    	Session::flash('message','El nivel '.$nivel->descripcion.' se ha guardado correctamente!');
		return view('maestros.niveles.show',compact('nivel'));
     }   

     public function postUpdate(Request $request,$id)
    {
    	$nivel = Nivel::find($id);
    	$nivel->descripcion=$request->input('descripcion');
    	$nivel->codigo=$request->input('codigo');
    	$nivel->color=$request->input('color');
    	$nivel->nivel=$request->input('nivel');
    	
        //obtenemos el campo imagen definido en el formulario
      
    	$nivel->save();
    	Session::flash('message','El nivel '.$nivel->descripcion.' se ha modificado correctamente!');
    	return view('maestros.niveles.show',compact('nivel'));
       
    }

    

	public function postDelete($id)
    {
    	$nivel = Nivel::find($id);
    	
    	$nivel->delete();
        Session::flash('message','El nivel '.$nivel->descripcion.' ha sido eliminado!');

    	

    	return redirect('niveles');
        
    }
}