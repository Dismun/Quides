<?php
namespace App\Http\Controllers\Maestros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Categoria;
use DB;

class CategoriasController extends Controller
{
     public function getIndex()
    {
        $arrayCategorias = Categoria::orderBy('activa','desc')->orderBy('descripcion','asc')->get();
        return view('maestros.categorias.index',compact('arrayCategorias'));
    }


     public function getCreate()
    {
        return view('maestros.categorias.create');
    }
     public function getShow($id)
    {	
    	$categoria = Categoria::find($id);
    	
        return view('maestros.categorias.show',compact('categoria'));
    }
     public function getEdit($id)
    {
        $categoria=Categoria::find($id);
        return view('maestros.categorias.edit',compact('categoria'));
    }

     public function postCreate(Request $request)
    {
    	$categoria = new Categoria;
    	$categoria->descripcion=$request->input('descripcion');
    	if ($request->has('activa'))
    		$categoria->activa=1;
    	else
    		$categoria->activa=0;
    	
    	
       
    	$categoria->save();
        
    	Session::flash('message','El categoria '.$categoria->descripcion.' se ha guardado correctamente!');
		return view('maestros.categorias.show',compact('categoria'));
     }   

     public function postUpdate(Request $request,$id)
    {
    	$categoria = Categoria::find($id);
    	$categoria->descripcion=$request->input('descripcion');
    	if ($request->has('activa'))
    		$categoria->activa=1;
    	else
    		$categoria->activa=0;
    	
        //obtenemos el campo imagen definido en el formulario
      
    	$categoria->save();
    	Session::flash('message','El categoria '.$categoria->descripcion.' se ha modificado correctamente!');
    	return view('maestros.categorias.show',compact('categoria'));
       
    }

    

	public function postDelete($id)
    {
    	$categoria = Categoria::find($id);
    	
    	$categoria->delete();
        Session::flash('message','El categoria '.$categoria->descripcion.' ha sido eliminado!');

    	

    	return redirect('categorias');
        
    }
}