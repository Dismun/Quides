<?php

namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use App\Dia;
use DB;

use Carbon\Carbon; /* Manipilacion de fechas */

class CalendariolaboralController extends Controller
{
     public function getIndex()

    {
    	$arrayDias = Dia::orderBy('fecha','desc')->get();
    	
		return view('maestros.dias.index',compact('arrayDias'));

      //  return view('maestros.dias.index')->with('arrayDias',DB::table('calendario_laboral')       	
	//		->orderBy('fecha','desc')
      //  	->get());
    }


     public function getCreate()
    {
        return view('maestros.dias.create');
    }
     public function getShow($id)
    {	
    	
    	$dia=Dia::find($id);
    	// table('calendario_laboral')->where('id', $id)->first();
        // $dia->fecha = new Carbon($dia->fecha);
        // $dia->fecha=$dia->fecha->format('d/m/y');
    	// dd($dia->fecha);

        return view('maestros.dias.show',compact('dia'));
    }
     public function getEdit($id)
    {
        return view('maestros.dias.edit',array ('id'=>$id))->with('dia',Dia::where('id', $id)->first());
    }

     public function postCreate(Request $request)
    {
    	$dia = new Dia;
    	$dia->descripcion=$request->input('descripcion');
    	$dia->fecha=$request->input('fecha');
    	$dia->tipo_fiesta=$request->input('tipo_fiesta');
    	
    	
       
    	$dia->save();
        
    	Session::flash('message','El día '.$dia->descripcion.' se ha guardado correctamente!');
		return view('maestros.dias.show',array ('id'=>$dia->id))->with('dia',$dia);
     }   

     public function postUpdate(Request $request,$id)
    {
    	$dia = Dia::find($id);
    	$dia->descripcion=$request->input('descripcion');
    	$dia->fecha=$request->input('fecha');
    	$dia->tipo_fiesta=$request->input('tipo_fiesta');
    	
    	
        //obtenemos el campo imagen definido en el formulario
      
    	$dia->save();
    	Session::flash('message','El día '.$dia->descripcion.' se ha modificado correctamente!');
    	return view('maestros.dias.show',array ('id'=>$dia->id))->with('dia',$dia);
       
    }

    

	public function postDelete($id)
    {
    	$dia = Dia::find($id);
    	
    	$dia->delete();
        Session::flash('message','El día '.$dia->descripcion.' ha sido eliminado!');

    	

    	return redirect('dias');
        
    }
}
