<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Bar_Tapa;
use Illuminate\Support\Facades\DB;



class BarTapaController extends Controller
{
    //


    /*------------------Index--------------------------------*/

//     public function index()
// {
//     $tapas = Tapa::with(['bars'])->get();
//     //dd($tapas); // Agregar esta línea
//     $bars = Bar::with(['tapas'])->get();   
//     return view('bar_tapa',compact('tapas','bars'));

// }

public function index()
{
    $bar_tapas = Bar_Tapa::all();
    $pivot_table = $bar_tapas->pluck('id')->toArray();
    $pivot_data = DB::table('bar_tapa')->whereIn('bar_tapa_id', $pivot_table)->get();
    return view('bar_tapa.index')->with('bar_tapas', $bar_tapas)->with('pivot_data', $pivot_data);
}



// public function index()
// {
//     $tapas = Tapa::all();
//     dd($tapas); // Agregar esta línea

//     $bars = Bar::all();
    
//     return view('bar_tapa.index', compact('tapas','bars'));
// }




 /*------------------Crear--------------------------------*/

// public function create()
// {
//     $listaTapas = Tapa::pluck('name', 'id');
//     $bars = Bar::pluck('name', 'id');
//     return view('bar_tapa.create', compact('listaTapas', 'bars'));
// }

public function create()
    {
        $bars = Bar::pluck('name', 'id');
        $tapas = Tapa::pluck('name', 'id');

        return view('bar_tapa.create', compact('bars','tapas'));
    }

 /*------------------Asignar--------------------------------*/
// public function assign(Request $request)
// {
//     $bar = Bar::findOrFail($request->input('bar_id'));
//     $bar->tapas()->attach($request->input('tapa_id'), [
//         'img'=>$request->input('img'),
//         'nombretapa' => $request->input('nombretapa'),
//         'nombrebar' => $request->input('nombrebar'),
//     ]);
//     return redirect()->route('bar_tapa.index');
// }

// public function store(Request $request)
// {

//     $validated = $request->validate([  
        
//         'tapa_id' => 'required|exists:tapas,id',
//         'bars' => 'array|required',
//         'bars.*' => 'exists:bars,id',         
//         'name'=> 'required|string|max:100',
//         'img'=>'required|max:10000|mimes:jpg,png,jpg',
//         'description' => 'required|string|max:2000',
//         'price' => 'required|numeric|between:0,99.99',
        
//     ]);
//     $tapa = Tapa::findOrFail($validated['tapa_id']);

//     $tapa->bars()->sync($validated['bars']);

//     return  redirect()->route('bar_tapa.index');
// }

// public function store(StoreBarTapaRequest $request)

// {
//     $tapa = Tapa::create($request->validated());
//     $bar = Bar::create($request->validated());


//     $tapa->bars()->sync($request->input('bars', []));
//     $bar->tapas()->sync($request->input('tapas', []));
//     return  redirect()->route('bar_tapa');
// }

// public function store(Request $request)

// { 

//     $validatedBar = $request->validate([
//                 'name' => 'required|max:255',
//                 'description' => 'required|max:2000',
//                 'address' => 'required|max:255',
//                 'phone' => 'required|max:20',
//                 'opening_hours' => 'required|max:255',
//             ]);

//     $validateTapa = $request->validate([
//             'name'=> 'required|string|max:100',
//             'img'=>'required|max:10000|mimes:jpg,png,jpg',
//              'description' => 'required|string|max:2000',
//              'price' => 'required|numeric|between:0,99.99',
        
//             ]);



//     $tapa = Tapa::create($validateTapa);
//     $bar = Bar::create($validatedBar);


//     $tapa->bars()->sync($request->input('bars', []));
//     $bar->tapas()->sync($request->input('tapas', []));
//     return  redirect()->route('bar_tapa')->with('success', 'Bar agregado correctamente');
// } 

// public function store(Request $request)
// {
//     $tapas = $request->input('tapas');
//     $bars = $request->input('bars');

//     foreach ($tapas as $tapa) {
//         foreach ($bars as $bar) {
//             // Crear el registro en la tabla bar_tapa con la tapa y el bar correspondiente
//             $bar_tapa = new Bar_Tapa;
//             $bar_tapa->tapa_id = $tapa;
//             $bar_tapa->bar_id = $bar;
//             $bar_tapa->save();
//         }
//     }

//     // Redireccionar a la vista bar:tapa.index con un mensaje de éxito
//     return redirect()->route('bar_tapa')->with('success', 'Tapa asignada exitosamente.');
// }
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

    // Comprobar si los datos se guardan correctamente
    //dd('Datos guardados correctamente.');

    // Redireccionar a la vista bar:tapa.index con un mensaje de éxito
    return redirect()->route('bar_tapa')->with('success', 'Tapa asignada exitosamente.');
}


// $campos=[

//     'name'=> 'required|string|max:100',
//     'img'=>'required|max:10000|mimes:jpg,png,jpg',
//     'description' => 'required|string|max:2000',
//     'price' => 'required|numeric|between:0,99.99',

//  ];
//  $mensaje=[
//      'required'=> 'El nombre es requerido',
//      'price.required'=>'El precio es requerido',
//      'description.required'=> 'La descripción es requerida',
//      'img.required'=>'La foto es requerida'
//  ];

//  $this->validate($request,$campos,$mensaje);
// //$datosTapas= request()->all();
// $datosTapas= request()->except('_token');

// if($request->hasFile('img')){

//     $datosTapas['img']=$request->file('img')->store('uploads','public');
// }
// Tapa::insert($datosTapas);
// //return response()->json($datosTapas);
// return redirect('tapa')->with('mensaje','Tapa agregada correctamente');


// public function store(Request $request)
// {
//     $validatedData = $request->validate([
//         'name' => 'required|max:255',
//         'description' => 'required|max:2000',
//         'address' => 'required|max:255',
//         'phone' => 'required|max:20',
//         'opening_hours' => 'required|max:255',
//     ]);

//     $bar = Bar::create($validatedData);

//     return redirect()->route('bar.index')
//         ->with('success', 'Bar agregado correctamente');
// }


/*------------------Delete--------------------------------*/

public function delete(Request $request)
{
    $bar = Bar::findOrFail($request->input('bar_id'));
    $bar->tapas()->detach($request->input('tapa_id'));
    return redirect()->route('bar_tapa.index');
}

 



}
