<?php
namespace App\Http\Controllers\Bosquejos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

use App\Calculo;
use App\Bosquejo;
use App\Chaman;
use App\Compoequipo;
use App\Dia;
use App\Externo;

use Carbon\Carbon;
use DB;





class CalculoController extends Controller
{
	 

     public function getForm()
    {
    	$fecha=Carbon::now();
    	
        

        return view('calculo.form',compact(['fecha']));
    

    }

     public function getCalculo(Request $request)
    {

    	$fechai=Carbon::createFromFormat('Y-m-d', $request->input('fechai')) ;
    	$fechaf=Carbon::createFromFormat('Y-m-d', $request->input('fechaf')) ;
    	$finicio=Carbon::createFromDate(2018,1,1);
    	
    	$fecha=$fechai->Copy();
    	
    	while ($fecha <= $fechaf) {
    		$c = new Calculo($fecha,$finicio);
    		// $fe[]=$fecha->format('d/m/Y');
    		// $c->dameGuardia();
    		// $c=null;
    		$fecha->addDay();

    	}
    	
    	// dd('paso');
        return view('calculo.bosquejo',compact(['fechai','fechaf']));
    

    }
    public function getPresenta(Request $request)
    {
		$fechai=Carbon::createFromFormat('Y-m-d', $request->input('fechai')) ;
    	$fechaf=Carbon::createFromFormat('Y-m-d', $request->input('fechaf')) ;
    	// $finicio=Carbon::createFromDate(2018,1,1);

    	return view('calculo.bosquejo',compact(['fechai','fechaf']));

    }

    public function getMuestra(Request $request)
    {
    	
    	$fechai=Carbon::createFromFormat('Y-m-d', $request->input('fechai')) ;
    	$fechaf=Carbon::createFromFormat('Y-m-d', $request->input('fechaf')) ;
		$finicio=Carbon::createFromDate(2018,1,1);
    	$bosq=DB::table('viewbosquejo2')->select('fecha','nombre','codigoturno','codigopunto','colornivel','colorcentro','codigocentro','colorequipo')
    	->orderBy('ordenequipo','asc')->orderBy('ideqcomp','asc')->orderBy('fecha','asc')
    	->where([['fecha','>=',$fechai->format('Y-m-d')],['fecha','<=',$fechaf->format('Y-m-d')]])->get();

    	$chamanes=DB::table('viewchamanes')->select('fecha','nombre','codigoturno','codigopunto','colornivel','colorcentro','codigocentro')
    	->whereIn('idpersona',
    		Chaman::select('idpersona')->get()
    	)
    	->orderBy('idpersona','asc')->orderBy('fecha','asc')
    	->where([['fecha','>=',$fechai->format('Y-m-d')],['fecha','<=',$fechaf->format('Y-m-d')]])->get();
    	// dd($chamanes);

    	$externos=DB::table('viewchamanes')->select('fecha','nombre','codigoturno','codigopunto','colornivel','colorcentro','codigocentro')
    /*	->whereNotIn('idpersona',
    		Chaman::select('idpersona')->get()
    	)
    	->whereNotIn('idpersona',
    		Compoequipo::select('idpersona')->get()
    	) */
    	->whereIn('idpersona',
    		Externo::select('idpersona')->get()
    	)
    	->where('idpersona','!=',0)
    	->orderBy('idpersona','asc')->orderBy('fecha','asc')
    	->where([['fecha','>=',$fechai->format('Y-m-d')],['fecha','<=',$fechaf->format('Y-m-d')]])->get();

		$otros=DB::table('viewchamanes')->select('fecha','nombre','codigoturno','codigopunto','colornivel','colorcentro','codigocentro')
    	->whereNotIn('idpersona',
    		Chaman::select('idpersona')->get()
    	)
    	->whereNotIn('idpersona',
    		Compoequipo::select('idpersona')->get()
    	)
    	->whereNotIn('idpersona',
    		Externo::select('idpersona')->get()
    	)
    	->where('idpersona','!=',0)
    	->orderBy('idpersona','asc')->orderBy('fecha','asc')
    	->where([['fecha','>=',$fechai->format('Y-m-d')],['fecha','<=',$fechaf->format('Y-m-d')]])->get();

    	$faltos=DB::table('bosquejo')->select('bosquejo.fecha','bosquejo.idturno','bosquejo.idpunto','turnos.codigo as codigoturno' ,'puntos.codigo as codigopunto','centros.color as colorcentro','niveles.color as colornivel')
    	->join('turnos','bosquejo.idturno','turnos.id')
    	->join('puntos','bosquejo.idpunto','puntos.id')
    	->join('centros','puntos.idcentro','centros.id')
    	->join('niveles','puntos.idnivel','niveles.id')
    	->orderBy('fecha','asc')
    	->where([['fecha','>=',$fechai->format('Y-m-d')],['fecha','<=',$fechaf->format('Y-m-d')],['idpersona',0]])->get();
    	

  //  	$festivos=Dia::select('fecha')
  //  	->where([['fecha','>=',$fechai->format('Y-m-d')],['fecha','<=',$fechaf->format('Y-m-d')]])->get();
		


        return view('calculo.muestra',compact(['fechai','fechaf','bosq','faltos','finicio','chamanes','externos','otros']));
    

    }


 	
}