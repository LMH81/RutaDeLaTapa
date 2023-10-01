<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Bar_Tapa;




class BarTapaController extends Controller
{
    //


    /*------------------Index--------------------------------*/

    // public function index()
    // {
    //     $bar_tapas = Bar_Tapa::all();
    //     dd($bar_tapas);
    //     return view('bar_tapa.index', compact('bar_tapas'));
    // }
  
    
//     public function index()
// {
//     $tapas = Tapa::with(['bars'])->get();
//     //dd($tapas); // Agregar esta línea
//     $bars = Bar::with(['tapas'])->get();   
//     return view('bar_tapa',compact('tapas','bars'));

// }



// public function index () {
//     $tapa= Tapa::find(1);
//     $bar= Bar::find(19);

//     return view('bar_tapa', compact('tapa', 'bar'));
// }


// public function index()
// {
//     $bar_tapas = Bar_Tapa::with('tapas', 'bars')->get();

//     return view('bar_tapa.index', compact('bar_tapas'));
// }

// public function index()
// {
//     $bar_tapas = Bar_Tapa::all();
//     $pivot_table = $bar_tapas->pluck('id')->toArray();
//     $pivot_data = DB::table('bar_tapa')->whereIn('bar_tapa_id', $pivot_table)->get();
//     return view('bar_tapa.index')->with('bar_tapas', $bar_tapas)->with('pivot_data', $pivot_data);
// }





public function index()
{
    $bars = Bar::with(['tapas'])->get();

    return view('bar_tapa', compact('bars'));
}

 /*------------------Crear--------------------------------*/

public function create()
    {
        $bars = Bar::pluck('name', 'id');
        $tapas = Tapa::pluck('name', 'id');

        return view('bar_tapa.create', compact('bars','tapas'));
    }


public function store(Request $request)
{
    $rules = [
        'tapas' => 'required|array|min:1',
        'bars' => 'required|array|min:1'
    ];

    $messages = [
        'tapas.required' => 'Debe seleccionar al menos una tapa',
        'bars.required' => 'Debe seleccionar al menos un bar'
    ];

    $this->validate($request, $rules, $messages);

    $tapas = $request->input('tapas');
    $bars = $request->input('bars');

    foreach ($tapas as $tapa) {
        foreach ($bars as $bar) {
            // Crear el registro en la tabla bar_tapa con la tapa y el bar correspondiente
            $bar_tapa = new Bar_Tapa;
            $bar_tapa->tapa_id = $tapa;
            $bar_tapa->bar_id = $bar;
            $bar_tapa->save();
        }
    }

    
    // Redireccionar a la vista bar:tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa')->with('success', 'Tapa asignada exitosamente.');
}



/*------------------Delete--------------------------------*/

public function delete(Request $request)
{
    $bar = Bar::findOrFail($request->input('bar_id'));
    $bar->tapas()->detach($request->input('tapa_id'));
    return redirect()->route('bar_tapa.index');
}

public function show($id)
{
    //
    $bar_tapa = Bar_Tapa::find($id);

    return view('bar_tapa.show', compact('bar_tapa'));
}



}
