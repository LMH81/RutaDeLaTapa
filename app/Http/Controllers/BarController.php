<?php

namespace App\Http\Controllers;
use App\Models\Bar;
use Illuminate\Http\Request;
use PDF;

class BarController extends Controller
{
    // public function index()
    // {
    //     $datos['bars'] = Bar::paginate(5);
    //     return view('bar.index', $datos);
    // }

     /*---------------Obtiene una colección de modelos de la tabla bars y los pagina para mostrarlos en la vista bar.index------------------ */
    public function index()
    {
        //
          
        $bars = Bar::paginate();

        return view('bar.index', compact('bars'))
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
        return redirect('bars')->with('mensaje','Tapa modificada');
    }

     /*---------------Borrar------------------ */
    public function destroy($id)
    {
        //
        // $bar = Bar::find($id)->delete();

        // return redirect()->route('bar.index')
        //     ->with('success', 'Bar eliminado correctamente');
   

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

}
