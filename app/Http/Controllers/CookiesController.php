<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Bar;
use App\Models\Tapa;
use App\Models\Voto;
use App\Models\Bar_Tapa;


class CookiesController extends Controller
{
    //

     /*------------Crear las cookies-----------------*/
    


    public function setCookie()
    {
        if (!request()->hasCookie('cookie_consent')) {
            return response(view('dashboard'))->withCookie('cookie_consent', Str::uuid(), 1);
        } else {
            session(['cookie_consent' => true]);
            return view('dashboard');
        }
    }   
   
    

 /*------------Extraer las cookies-----------------*/
    public function getCookie (){
        return request()->cookie('cookie_consent');
    }

    /*------------Borrar cookies-----------------*/


public function delCookie()
{
    return redirect()->route('cookies_required')->withCookie(cookie()->forget('cookie_consent'))->withSession(['cookie_consent' => false]);
}

/*-----------------Método Index------------------------------------------------------------- */

public function index()
    { 
        $bar_tapas = Tapa::whereHas('bars')->with(['bars'])->get();
        $grouped_tapas = [];
        
        foreach ($bar_tapas as $tapa) {
            foreach ($tapa->bars as $bar) {
                $bartapa_Id = $bar->pivot->id; // Obtiene el bartapa_Id de la relación intermedia            
                $grouped_tapas[$bar->name][] = [
                    'tapa' => $tapa,
                    'bartapa_Id' => $bartapa_Id,
                    'address' => $bar->address,
                    'opening_hours' =>$bar-> opening_hours,
                ];
            }
             
        }
        
        return view('cookies.dashboard', compact('grouped_tapas', 'bar_tapas'));
    }

}