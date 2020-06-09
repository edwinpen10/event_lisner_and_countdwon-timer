<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use App\Rolemenu;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rolemenus = Rolemenu::where('id_user', Auth::user()->id)->with('menu')->get();
        Redis::set('email-'.Auth::user()->id, Auth::user()->email);
        $user = Redis::get('email-'.Auth::user()->id);
        return view('home', compact('rolemenus','user'));

    }
}
