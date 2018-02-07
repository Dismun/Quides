<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\lain;
use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use DB;
use Notification;

class CatalogController extends Controller
{

	
	

	

    public function getIndex()
    {
    	
        return view('catalog.index')->with('arrayPeliculas',DB::table('movies')->get());
    }
     public function getCreate()
    {
        return view('catalog.create');
    }
     public function getShow($id)
    {
    	// Notification::warning('Muestra de Pelicula');
    	$pelicula=new Movie;
    	$pelicula=DB::table('movies')->where('id', $id)->first();
        return view('catalog.show',array ('id'=>$id))->with('pelicula',$pelicula);
    }
     public function getEdit($id)
    {
        return view('catalog.edit',array ('id'=>$id))->with('pelicula',DB::table('movies')->where('id', $id)->first());
    }

     public function postCreate(Request $request)
    {
    	$peli = new Movie;
    	$peli->title=$request->input('title');
    	$peli->year=$request->input('year');
    	$peli->director=$request->input('director');
    	$peli->synopsis=$request->input('synopsis');
    	$peli->poster=$request->input('poster');
    	$peli->rented='1';
    	$peli->save();
    	Notification::success('La película se ha guardado correctamente');
		return view('catalog.show',array ('id'=>$peli->id))->with('pelicula',$peli);
        // return view('catalog.show')->with('arrayPeliculas',DB::table('movies')->get());
    }

     public function postUpdate(Request $request,$id)
    {
    	$peli = Movie::find($id);
    	$peli->title=$request->input('title');
    	$peli->year=$request->input('year');
    	$peli->director=$request->input('director');
    	$peli->synopsis=$request->input('synopsis');
    	$peli->poster=$request->input('poster');
    	$peli->save();
    	Notification::success('La película se ha modificado correctamente');
    	return view('catalog.show',array ('id'=>$peli->id))->with('pelicula',$peli);
        // return view('catalog.index')->with('arrayPeliculas',DB::table('movies')->get());
    }

     public function postRent($id)
    {
    	$peli = Movie::find($id);
    	
    	$peli->rented = '1';
    	$peli->save();
    	Notification::success('La película está disponible para alquilar');
    	
    	return view('catalog.show',array ('id'=>$peli->id))->with('pelicula',$peli);
        
    }
	public function postReturn($id)
    {
    	$peli = Movie::find($id);
    	
    	$peli->rented = '0';
    	$peli->save();
    	Notification::success('La película se ha alquilado');
    	return view('catalog.show',array ('id'=>$peli->id))->with('pelicula',$peli);
        
    }

	public function postDelete($id)
    {
    	$peli = Movie::find($id);
    	
    	$peli->delete();
    	Notification::success('La película se ha borrado');
    	return view('catalog.index')->with('arrayPeliculas',DB::table('movies')->get());
        
    }
}
