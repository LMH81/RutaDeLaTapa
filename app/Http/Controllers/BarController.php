<?php

namespace App\Http\Controllers;
use App\Models\Bar;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\View;

class BarController extends Controller
{
    
     /*---------------Obtiene una colección de modelos de la tabla bars y los pagina para mostrarlos en la vista bar.index------------------ */
  
    public function index(Request $request)
    {
        $search = $request->input('search', ''); // Obtener el término de búsqueda
    
        // Realizar la búsqueda si se ha proporcionado un término de búsqueda
        if (!empty($search)) {
            $bars = Bar::where('name', 'like', "%$search%")
                ->orWhere('description', 'like', "%$search%")
                ->orWhere('address', 'like', "%$search%")
                ->paginate(); 
        } else {
            // Mostrar todos los bares si no se ha proporcionado un término de búsqueda
            $bars = Bar::paginate(5); // Muestra 5 elementos por página
        }
    
        return view('bar.index', compact('bars', 'search'))
            ->with('i', (request()->input('page', 1) - 1) * $bars->perPage());
    }
    


    
/*-------------------PDF----------------------*/
    public function pdf()
    {
        $bars = Bar::paginate();
    
        $pdf = PDF::loadView('bar.pdf',['bars'=>$bars]);
      
        return $pdf->stream();
    
        
        
    }
 /*---------------Crear------------------ */
   
    public function create()
    {
        //
        $bar = new Bar();
        return view('bar.create', compact('bar'));
    }

     /*---------------Crear y guardar------------------ */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:2000',
            'address' => 'required|max:255',
            'phone' => 'required|max:20',
            'opening_hours' => 'required|max:255',
        ]);
    
        $bar = Bar::create($validatedData);
    
        return redirect()->route('bar.index')
            ->with('success', 'Bar agregado correctamente');
    }
    
 /*---------------Mostrar------------------ */
   
 public function show($id)
 {
     //
     $bar = Bar::find($id);

     return view('bar.show', compact('bar'));
 }

  /*--------------Editar---------------------------------- */
    public function edit($id)
    {
        //
        $bar=Bar::find($id);
        return view('bar.edit',compact('bar'));
    }

   /*---------------Actualizar------------------ */
    public function update(Request $request, $id)
    {
        //

         $validatedData = $request->validate(Bar::rules());

        // $bar->update($validatedData);
    
        // return redirect()->route('bar.index')
        //     ->with('success', 'Bar actualizado correctamente');

        Bar::where('id','=',$id)->update($validatedData);
        $bar=Bar::find($id);      
        return redirect('bars')->with('mensaje','bar modificado');
    }

     /*---------------Borrar------------------ */
    public function destroy($id)
    {
         
         $bar = Bar::find($id);

        if ($bar) {
            $bar->delete();
            return redirect()->route('bar.index')
                ->with('success', 'Bar eliminado correctamente');
        } else {
            return redirect()->route('bar.index')
                ->with('error', 'No se encontró el bar que intenta eliminar');
        }
}


/*--------------------Geolocalización---------------------- */

public function getCoordinates($barId)
{
        $bar = Bar::find($barId);
    
    if (!$bar) {
        return response()->json(['error' => 'Bar not found'], 404);
    }
    
    $coordinates = [
        'latitude' => $bar->latitude,
        'longitude' => $bar->longitude,
    ];
   
    return response()->json($coordinates);
}


}