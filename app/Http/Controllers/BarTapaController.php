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
    $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->paginate(2);
    $grouped_tapas = [];
    
    foreach ($bar_tapas as $tapa) {
        foreach ($tapa->bars as $bar) {
            $bartapa_Id = $bar->pivot->id; // Obtiene el bartapa_Id de la relación intermedia
            $grouped_tapas[$bar->name][] = [
                'tapa' => $tapa,
                'bartapa_Id' => $bartapa_Id,
            ];
        }
         // dd($grouped_tapas);
    }
    
    return view('bar_tapa.index', compact('grouped_tapas', 'bar_tapas'));
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
            }else{
                // Si la relación ya existe, muestra un mensaje de error y redirecciona
                if ($existingRelation) {
                return redirect()
        ->route('bar_tapa.index')
        ->with('error', 'La relación ya existe.'); // Agrega un mensaje de error
}
            }
        }
    }

       
    // Redireccionar a la vista bar:tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa.index')->with('success', 'Relación asignada exitosamente.');
}



/*------------------Delete--------------------------------*/

public function destroy($id)
{
    // Busca la relación en la tabla pivote por su ID
    $barTapa = Bar_Tapa::find($id);

    //dd($barTapa);

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
    $barTapa = Bar_Tapa::find($id);
    
     

    if (!$barTapa) {
        return redirect()->route('bar_tapa.index')->with('error', 'La relación no fue encontrada.');
    }   
   

    // Puedes incluir otros detalles de la relación 'Bar_Tapa' aquí, si es necesario

    return view('bar_tapa.show', compact('barTapa'));
}




}