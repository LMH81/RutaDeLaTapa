<?php

namespace App\Http\Controllers;

use App\Models\Tapa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;




class TapaController extends Controller
{
   
   /*---------------Muestra una lista paginada de bares----------------- */

    public function index()
{
    $tapas = Tapa::paginate();
    return view('tapa.index', compact('tapas'))
        ->with('i', (request()->input('page', 1) - 1) * $tapas->perPage());
}

/*-------------------PDF----------------------*/
public function pdf()
{
    $tapas = Tapa::paginate();

    $pdf = PDF::loadView('tapa.pdf',['tapas'=>$tapas]);
  
    return $pdf->stream();    
    
}

 /*---------------EL método crear te redirecciona------------------ */   
    public function create()
    {        
        $tapa = new Tapa();
        return view('tapa.create', compact('tapa'));
    }

    /*---------------Crear y guardar---------------------------------- */
    public function store(Request $request)
    {
        //
         $campos=[
            'name'=> 'required|string|max:1000',
            'img'=>'required|max:10000|mimes:jpg,png,jpg',
            'description' => 'required|string|max:2000',
            'price' => 'required|numeric|between:0,99.99',
         ];
         $mensaje=[
             'required'=> 'El nombre es requerido',
             'price.required'=>'El precio es requerido',
             'description.required'=> 'La descripción es requerida',
             'img.required'=>'La foto es requerida'
         ];

         $this->validate($request,$campos,$mensaje);
        //$datosTapas= request()->all();
        $datosTapas= request()->except('_token');

        if($request->hasFile('img')){

            $datosTapas['img']=$request->file('img')->store('uploads','public');
        }
        Tapa::insert($datosTapas);
        //return response()->json($datosTapas);
        return redirect('tapa')->with('mensaje','Tapa agregada correctamente');
    }

     /*---------------Mostrar----------------------------------------------*/
  
    public function show($id)
    {
        //
        $tapa = Tapa::find($id);

        return view('tapa.show', compact('tapa'));
    }

  /*---------------Editar----------------------------------------------------- */
    public function edit($id)
    {
        //
        $tapa=Tapa::find($id);
        return view('tapa.edit',compact('tapa'));
    }

   /*---------------Actualizar----------------------------------------------------- */
    public function update(Request $request, $id)
    {
                 
        $datosTapas= request()->except(['_token','_method']);

        if($request->hasFile('img')){

            $tapa=Tapa::find($id);
            Storage::delete('public/'.$tapa->img);
            $datosTapas['img']=$request->file('img')->store('uploads','public');
        }

        Tapa::where('id','=',$id)->update($datosTapas);
        $tapa=Tapa::find($id);
        //return view('tapa.edit',compact('tapa'));
        return redirect('tapa')->with('mensaje','Tapa modificada');
    }

  /*---------------Borrar-----------------------------------------------------------*/
    public function destroy($id)
    {
        //

        $tapa=Tapa::find($id);

        if(Storage::delete('public/'.$tapa->img)){
            Tapa::destroy($id);

        }
        
        return redirect('tapa')->with('mensaje','Tapa eliminada');
    }


    
   
    
}
