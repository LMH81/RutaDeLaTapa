<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voto;
use App\Models\Bar_Tapa;
use Auth; 
use App\Models\Bar;
use App\Models\Tapa;

 


class VotoController extends Controller
{
    
    /*------------Método Index---------------------------------------------------- */
    public function index()
{ 
    $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->paginate(3);
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

    // Verificar si el usuario ya votó por esa bar_tapa_id
    $existingVote = Voto::where('user_id', $user->id)
        ->where('bar_tapa_id', $request->input('bar_tapa_id'))
        ->first();

    if ($existingVote) {
        
        return redirect()->route('voto.user-voto')->with('error', 'Ya has votado por esta bar_tapa.');
    }


    $voto = new Voto([
        'user_id' => $user->id,
        'bar_tapa_id' => $request->input('bar_tapa_id'),
        'rating' => $request->input('rating'),
        'comment' => $request->input('comment'),
    ]);

    $voto->save();

    return redirect()->route('voto.user-voto')->with('success', 'Voto registrado con éxito');

}

/*-----------------------Votos de un Usuario---------------------------- */
public function getUserVotos()
{
    // Obtén el usuario autenticado
    $user = Auth::user();

    // Obtén todos los votos del usuario con las relaciones cargadas
    $votos = Voto::where('user_id', $user->id)->get();

    $votosWithNames = $votos->map(function ($voto) {
        $barTapa = Bar_Tapa::find($voto->bar_tapa_id);
        $tapa = Tapa::find($barTapa->tapa_id);
        $bar = Bar::find($barTapa->bar_id);

        return [
            'voto' => $voto,
            'tapa' => $tapa->name,
            'img' => $tapa->img,
            'bar' => $bar->name,
        ];
    });

    return view('voto.user-voto', compact('votosWithNames'));
}

/*--------------------Método Editar--------------------------------------------------- */

public function edit($id)
{
    $voto = Voto::findOrFail($id);
    // Obtenemos los datos de la tapa relacionada con el voto
    $barTapa = Bar_Tapa::find($voto->bar_tapa_id);
    $tapa = Tapa::find($barTapa->tapa_id);
    $bar=Bar::find($barTapa->bar_id);
    
    return view('voto.edit', compact('voto', 'tapa', 'bar'));
}


/*-------------------------Método Update----------------------------- */
public function update(Request $request, $id)
{
    $request->validate([
        'rating' => 'required|integer|between:1,5',
        'comment' => 'nullable|string|max:255',
    ]);

    $voto = Voto::findOrFail($id);

    $voto->rating = $request->input('rating');
    $voto->comment = $request->input('comment');

    $voto->save();

    return redirect()->route('voto.user-voto')->with('success', 'Voto actualizado con éxito');
}

/*----------------------------Método Destroy o Eliminar------------------------------------------------------- */
public function destroy($id)
{
    // Encuentra el voto por su ID
    $voto = Voto::find($id);

    // Verifica si el voto se encontró
    if (!$voto) {
        return redirect()->route('voto.user-voto')->with('error', 'El voto no se encontró.');
    }
  
    // Elimina el voto de la base de datos
    $voto->delete();

    // Redirige a la vista de votos del usuario con un mensaje de éxito
    return redirect()->route('voto.user-voto')->with('success', 'El voto se eliminó con éxito.');
}




}