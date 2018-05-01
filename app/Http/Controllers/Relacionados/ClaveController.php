<?php
namespace App\Http\Controllers\Relacionados;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use App\Clave;
use App\Turno;



class ClaveController extends Controller
{
     public function getIndex()
    {
        $arrayClave = Clave::join('turnos', 'clave.idturno', '=', 'turnos.id')
        ->select('clave.*', 'turnos.descripcion', 'turnos.codigo', 'turnos.desde','turnos.hasta')->orderBy('clave.orden','asc')->get();
        return view('relacionados.clave.index',compact('arrayClave'));
    

    }



     Public function getSubir($id)
     {
        $clave = Clave::find($id);
        $clave->orden=($clave->orden - 150) ;
        $clave->save();
        
        $arrayClave = Clave::join('turnos', 'clave.idturno', '=', 'turnos.id')
        ->select('clave.*', 'turnos.descripcion', 'turnos.codigo', 'turnos.desde','turnos.hasta')->orderBy('clave.orden','asc')->get();
        $intervalo=100;

        foreach( $arrayClave as $key => $clave )
        {
            $clave->orden=$intervalo;

            $intervalo=$intervalo + 100;

            $clave->save();
        }


        return redirect('clave');

    }
     public function getBajar($id)
    {
        $clave = Clave::find($id);
        $clave->orden=($clave->orden + 150) ;
        $clave->save();
        
        $arrayClave = Clave::join('turnos', 'clave.idturno', '=', 'turnos.id')
        ->select('clave.*', 'turnos.descripcion', 'turnos.codigo', 'turnos.desde','turnos.hasta')->orderBy('clave.orden','asc')->get();
        $intervalo=100;

        foreach( $arrayClave as $key => $clave )
        {
            $clave->orden=$intervalo;

            $intervalo=$intervalo + 100;
            
            $clave->save();
        }


        return redirect('clave');

    }

     public function getInsertar($id)
    {
        $clavepost = Clave::find($id);
        $clavee = new Clave;
        $clavee->orden=$clavepost->orden-50;
        $clavee->idturno=$clavepost->idturno;
        $clavee->save();
        $arrayTurnos = Turno::orderBy('descripcion', 'asc')->get();

        $arrayClave = Clave::join('turnos', 'clave.idturno', '=', 'turnos.id')
        ->select('clave.*', 'turnos.descripcion', 'turnos.codigo', 'turnos.desde','turnos.hasta')->orderBy('clave.orden','asc')->get();

        return view('relacionados.clave.edit',compact(['arrayClave','clavee','arrayTurnos']));

    }


    public function postInsertar(Request $request,$id)
    {
        $clave = Clave::find($id);
        
        $clave->idturno=$request->input('idturno');

        $clave->save();
        
        $arrayClave = Clave::join('turnos', 'clave.idturno', '=', 'turnos.id')
        ->select('clave.*', 'turnos.descripcion', 'turnos.codigo', 'turnos.desde','turnos.hasta')->orderBy('clave.orden','asc')->get();
        $intervalo=100;

        foreach( $arrayClave as $key => $clave )
        {
            $clave->orden=$intervalo;

            $intervalo=$intervalo + 100;
            
            $clave->save();
        }

        
       
        Session::flash('message','El turno '.$clave->descripcion.' se ha añadico correctamente a la clave!');

        return redirect('clave');
        
    }
     
    

	public function postDelete($id)
    {
    	$clave = Clave::find($id);
    	
    	$clave->delete();
        Session::flash('message','El turno '.$clave->descripcion.' ha sido eliminado de la clave!');

    	

    	return redirect('clave');
        
    }
}