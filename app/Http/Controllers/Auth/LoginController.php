<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
   
     public function login(Request $request)
     {  

        $input = $request->all();

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {
            toastr()->success('Login successfully!');
           
            
           return redirect()->route('home');
            
        }else{

            toastr()->error('Login failed please try again later.');
            return redirect()->route('login');
            
        }

          
        
     }

     public function logout()
     {
        Redis::del('email-'.Auth::user()->id);
        Auth::logout();
        return redirect('/');
     }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
