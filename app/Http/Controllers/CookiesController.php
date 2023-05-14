<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CookiesController extends Controller
{
    //

     /*------------Crear las cookies-----------------*/
    // public function setCookie(){
    //     //$response = response ('Aceptación de las Cookies');
    //     //$response->withCookie('cookie_consent', Str::uuid(),1);
    //     if (!request()->hasCookie('cookie_consent')){
    //         return response(view('dashboard'))->withCookie('cookie_consent', Str::uuid(),1);
    //     }

    //     return view ('dashboard');
    
    // }


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

//     public function delCookie(){
//          return response ('Cookies rechazadas')->cookie('cookie_consent',null, -1);

//     }

public function delCookie()
{
    return redirect()->route('cookies_required')->withCookie(cookie()->forget('cookie_consent'))->withSession(['cookie_consent' => false]);
}



}
