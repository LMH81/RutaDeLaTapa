<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        //$this->middleware('auth')->only('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Log::info('User role: ' . $user->role);
        // dd(request()->route());
        if ($user->hasRole('admin')) {
            return redirect()->route('bar_tapa.dashboard');
        } else {
            return redirect()->route('cookies.dashboard');
        }
        
    }


    public function logout(Request $request)
    {
        $redirectTo = '/'; 
    
        // if (Auth::check() && Auth::user()->hasRole('admin')) {
        //     $redirectTo = '/login'; 
        // }
    
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->to($redirectTo);
    }
    

}