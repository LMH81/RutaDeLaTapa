<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Voto;
use App\Models\Bar_Tapa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }

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
             
        }
        
        return view('dashboard', compact('grouped_tapas', 'bar_tapas'));
    }
}