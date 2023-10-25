<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voto;
use App\Models\Bar_Tapa;
use Auth; // Importar la clase Auth para obtener el usuario autenticado
use App\Models\Bar;
use App\Models\Tapa;

 


class VotoController extends Controller
{
    // public function votarTapaBar(Request $request,$bar_tapa_id)
    // {
    //     // Validar la solicitud 
    //     $request->validate([
    //         'bar_tapa_id' => 'required|exists:bar_tapa,id',
    //         'rating' => 'required|integer|between:1,5',
    //         'comment' => 'nullable|string|max:255',
    //     ]);

    //     // Obtener el usuario autenticado
    //     $user = Auth::user();

    //     // Crear un nuevo voto
    //     $voto = new Voto([
    //         'user_id' => $user->id,
    //         'bar_tapa_id' => $request->input('bar_tapa_id'),
    //         'rating' => $request->input('rating'),
    //         'comment' => $request->input('comment'),
    //     ]);

    //     // Guardar el voto en la base de datos
    //     $voto->save();

    //     // Puedes redirigir al usuario a una página de éxito o realizar cualquier otra acción necesaria.
    //     // Por ejemplo:
    //     return redirect()->route('voto-exito')->with('success', 'Voto registrado con éxito');
    // }

    // public function index()
    // {
       
    //     $barTapas = Bar_Tapa::with('votos')->get();
    //     return view('voto.index', compact('barTapas'));
    // }


    /*------------Método Index---------------------------------------------------- */
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
    
    return view('voto.index', compact('grouped_tapas', 'bar_tapas'));
}
    
/*-----------------Método Create------------------------------------------- */
public function create($id)
{
    $barTapa = Bar_Tapa::findOrFail($id);
    $tapa = Tapa::find($barTapa->tapa_id);
    $bar = Bar::find($barTapa->bar_id);
    
    return view('voto.create', compact('barTapa','tapa', 'bar'));
}

/*----------------------Método Store-------------------------------------- */
public function store(Request $request)
{
    $request->validate([
        'bar_tapa_id' => 'required|exists:bar_tapa,id',
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string|max:255',
    ]);

    $user = Auth::user();

    $voto = new Voto([
        'user_id' => $user->id,
        'bar_tapa_id' => $request->input('bar_tapa_id'),
        'rating' => $request->input('rating'),
        'comment' => $request->input('comment'),
    ]);

    $voto->save();

    return redirect()->route('voto-exito')->with('success', 'Voto registrado con éxito');
}

}