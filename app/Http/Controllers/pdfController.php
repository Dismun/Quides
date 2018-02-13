<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class pdfController extends Controller
{
    public function invoice() 
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
       /* si queremos descqrgar retornar 
			return $pdf->download('nombre_archivo'); */

        return $pdf->stream('invoice');
    }
 
    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

    public function getRelacionGuardias(Request $request)
    {
        $fechai=Carbon::createFromFormat('Y-m-d', $request->input('fechai')) ;
        $fechaf=Carbon::createFromFormat('Y-m-d', $request->input('fechaf')) ; 
        $data = DB::table('bosquejo')->select('personas.nombre as nombre','bosquejo.idpersona' ,DB::raw('count(bosquejo.idturno) as guardias'))
        ->join('personas','bosquejo.idpersona','personas.id') 
        ->where([['bosquejo.fecha','>=',$fechai->format('Y-m-d')],['bosquejo.fecha','<=',$fechaf->format('Y-m-d')],['bosquejo.idturno',3]])
        ->groupBy('nombre','bosquejo.idpersona')->get();
        //dd($data);
        $view =  \View::make('pdf.relacionguardias', compact('data', 'fechai', 'fechaf'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
       /* si queremos descqrgar retornar 
            return $pdf->download('nombre_archivo'); */

        return $pdf->stream('relacionguardias');
    }

      public function getForm()
    {
        $fecha=Carbon::now();
        
        
        return view('pdf.formpdf',compact(['fecha']));
    

    }
 
    
}
