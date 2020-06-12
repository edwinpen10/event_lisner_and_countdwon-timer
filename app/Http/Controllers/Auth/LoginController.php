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

        $token = $request->server->all();
        $token1 =$token['HTTP_COOKIE'];
       
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);
        $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if(auth()->attempt(array($fieldType => $input['email'], 'password' => $input['password'])))
        {
            toastr()->success('Login successfully!');
           
            $this->fcm($token1);
           
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

     public function fcm($token1)
     {
          $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
         $token=$token1;
     
 
     $notification = [
         'body' => 'this is test',
         'sound' => true,
     ];
     
     $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
 
     $fcmNotification = [
         //'registration_ids' => $tokenList, //multple token array
         'to'        => $token, //single token
         'notification' => $notification,
         'data' => $extraNotificationData
     ];
 
     $headers = [
         'Authorization: key=AAAAhWl4HS4:APA91bFpDRifwsHNz4FY_ZfCrT-vrtkfmbMO_dc_MKG4ph2aWc_YtT9E0gHhIAnaoSuq6NoNOcwytuCYYcfwP80aUOGDgbKwFa79VToEZJVR179MRoPYratYvUx2hGIjhon8ZCxdv9Rc',
         'Content-Type: application/json'
     ];
 
 
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL,$fcmUrl);
     curl_setopt($ch, CURLOPT_POST, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
     $result = curl_exec($ch);
     curl_close($ch);
 
 
    //  dd($result);
 
             
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
