<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Centro;
use App\Calculo;
use Carbon\Carbon;
use DB;
class CentrosController extends Controller
{
     public function getIndex()
    {
        $arrayCentros = Centro::get();
        return view('maestros.centros.index', compact('arrayCentros'));
    }

     public function getCreate()
    {
        return view('maestros.centros.create');
    }
     public function getShow($id)
    {	   	

        $centro=Centro::find($id);

        
        return view('maestros.centros.show',compact('centro'));
    }
     public function getEdit($id)
    {
        $centro=Centro::find($id);
        
        return view('maestros.centros.edit',compact('centro'));
    }

     public function postCreate(Request $request)
    {
    	$centro = new Centro;
    	$centro->descripcion=$request->input('descripcion');
    	$centro->codigo=$request->input('codigo');
    	$centro->color=$request->input('color');
    	$centro->direccion=$request->input('direccion');
    	$centro->telefonos=$request->input('telefonos');
    	$centro->poblacion=$request->input('poblacion');
        

        //obtenemos el campo imagen definido en el formulario
        $file = $request->file('imagen');
        if ($file)
        {
            //obtenemos el nombre del archivo
            $nombre = 'centros/'.$file->getClientOriginalName();
 
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));

            $centro->imagen=$nombre;
        }
    	$centro->save();
        
    	Session::flash('message','El Centro '.$centro->codigo.' se ha guardado correctamente!');
		return view('maestros.centros.show',compact('centro'));
        // return view('maestros.centros.show')->with('arraycentros',DB::table('centros')->get());
    }

     public function postUpdate(Request $request,$id)
    {
    	$centro = Centro::find($id);
    	$centro->descripcion=$request->input('descripcion');
    	$centro->codigo=$request->input('codigo');
    	$centro->color=$request->input('color');
    	$centro->direccion=$request->input('direccion');
    	$centro->telefonos=$request->input('telefonos');
    	$centro->poblacion=$request->input('poblacion');
        //obtenemos el campo imagen definido en el formulario
      
        $file = $request->file('imagen');
        
        if ($file)
        {
            //obtenemos el nombre del archivo
            $nombre = 'centros/'.$file->getClientOriginalName();
        
        
              //indicamos que queremos guardar un nuevo archivo en el disco local
           \Storage::disk('local')->put($nombre,  \File::get($file));

            $centro->imagen=$nombre;
        }
    	$centro->save();
    	Session::flash('message','El Centro '.$centro->codigo.' se ha modificado correctamente!');
    	return view('maestros.centros.show',compact('centro'));
        
    }

    

	public function postDelete($id)
    {
    	$centro = Centro::find($id);
    	
    	$centro->delete();
        Session::flash('message','El Centro '.$centro->codigo.' ha sido eliminado!');

    	

    	return redirect('centros');
        
    }
}