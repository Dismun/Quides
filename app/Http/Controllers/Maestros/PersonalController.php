<?php



namespace App\Http\Controllers\Maestros;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Persona;
use DB;

class PersonalController extends Controller
{
     public function getIndex()
    {
        $arrayPersonal = Persona::orderBy('activo','desc')
            ->orderby('nombre','asc')
            ->get();

        return view('maestros.personal.index',compact('arrayPersonal'));
    }

    public function getIndex2()
    {
         $arrayPersonal = Persona::orderBy('activo','desc')
            ->orderby('nombre','asc')
            ->get();
        return view('maestros.personal.index2',compact('arrayPersonal'));
        
    }

     public function getCreate()
    {
        return view('maestros.personal.create');
    }
     public function getShow($id)
    {	
    	$persona = Persona::find($id);
    	
        return view('maestros.personal.show',compact('persona'));
    }
     public function getEdit($id)
    {
        $persona = Persona::find($id);
        if ($id != 0)
           return view('maestros.personal.edit',compact('persona'));
       else
            return redirect('personal');
    }

     public function postCreate(Request $request)
    {
    	$persona = new Persona;
    	$persona->nombre=$request->input('nombre');
    	$persona->telefonos=$request->input('telefonos');
    	$persona->email=$request->input('email');
    	if ($request->has('activo'))
    		$persona->activo=1;
    	else
    		$persona->activo=0;

        //obtenemos el campo imagen definido en el formulario
       $file = $request->file('urlfoto');
        if ($file)
        {
            //obtenemos el nombre del archivo
            $nombre = 'personal/'.$file->getClientOriginalName();
 
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('local')->put($nombre,  \File::get($file));

            $persona->urlfoto=$nombre;
        }
    	$persona->save();
        
    	Session::flash('message','La persona '.$persona->nombre.' se ha guardado correctamente!');
		return view('maestros.personal.show',compact('persona'));
        // return view('maestros.personal.show')->with('arraypersonal',DB::table('personal')->get());
    }

     public function postUpdate(Request $request,$id)
    {
    	$persona = Persona::find($id);
    	$persona->nombre=$request->input('nombre');
    	$persona->telefonos=$request->input('telefonos');
    	$persona->email=$request->input('email');
    	if ($request->has('activo'))
    		$persona->activo=1;
    	else
    		$persona->activo=0;
    	
        //obtenemos el campo imagen definido en el formulario
      
        $file = $request->file('urlfoto');
        
        if ($file)
        {
            //obtenemos el nombre del archivo
            $nombre = 'personal/'.$file->getClientOriginalName();
        
        
              //indicamos que queremos guardar un nuevo archivo en el disco local
           \Storage::disk('local')->put($nombre,  \File::get($file));

            $persona->urlfoto=$nombre;
        }
    	$persona->save();
    	Session::flash('message','La persona '.$persona->nombre.' se ha modificado correctamente!');
    	return view('maestros.personal.show',compact('persona'));
        // return view('maestros.personal.index')->with('arraypersonal',DB::table('personal')->get());
    }

    

	public function postDelete($id)
    {
        $persona = Persona::find($id);
    	if ($id != 0) {                	
       	   $persona->delete();
            Session::flash('message','La persona '.$persona->nombre.' ha sido eliminado!');
        }
        else
            Session::flash('message','La persona '.$persona->nombre.' no es posible eliminarla!');
    	

    	return redirect('personal');
        
    }
}

