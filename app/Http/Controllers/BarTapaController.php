<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Bar_Tapa;




class BarTapaController extends Controller
{
   
public function index()
{ 
    $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->get();
    $grouped_tapas = [];
    
    foreach ($bar_tapas as $tapa) {
        foreach ($tapa->bars as $bar) {
            $pivot_id = $bar->pivot->id;
            $grouped_tapas[$bar->name][] = $tapa;
        }
    }
    
    return view('bar_tapa.index', compact('grouped_tapas'));
    

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
            // Verifica si ya existe una relación entre la tapa y el bar
            $existingRelation = Bar_Tapa::where('tapa_id', $tapa)->where('bar_id', $bar)->first();

            if (!$existingRelation) {
                // Si no existe la relación, crea un nuevo registro en la tabla bar_tapa
                $bar_tapa = new Bar_Tapa;
                $bar_tapa->tapa_id = $tapa;
                $bar_tapa->bar_id = $bar;
                $bar_tapa->save();
            }
        }
    }



    
    // Redireccionar a la vista bar:tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa.index')->with('success', 'Tapa asignada exitosamente.');
}



/*------------------Delete--------------------------------*/

public function destroy($id)
{
    // Busca la relación en la tabla pivote por su ID
    $barTapa = Bar_Tapa::find($id);

    if (!$barTapa) {
        // Maneja el caso en el que la relación no existe
        return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
    }

    // Elimina la relación en la tabla pivote
    $barTapa->delete();

    // Redirecciona a la vista bar_tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa.index')->with('success', 'Relación eliminada exitosamente.');
}




public function show($id)
{
    //
    $bar_tapa = Bar_Tapa::find($id);

    return view('bar_tapa.show', compact('bar_tapa'));
}



}
