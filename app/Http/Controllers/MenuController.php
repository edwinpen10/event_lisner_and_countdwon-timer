<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Menu;
use App\User;
use App\Rolemenu;

class MenuController extends Controller
{
    public function list()
    {
        $menus=Menu::all();
        return view('menu',compact('menus'));
    }

    public function store(Request $request)
    {
        $model=Menu::create([
            'menu_name' => $request->menu,
            'address' => $request->address
        ]);



        return redirect()->route('menu');
    }

    public function setrole()
    {
        $users=User::all();
        $menus=Menu::all();
        $rolemenus = Rolemenu::where('id_user', Auth::user()->id)->with('menu')->get();
        return view('setrole',compact('menus','users','rolemenus'));
    }

    public function storerole(Request $request)
    {
    
        for ($i=0; $i < count($request->role) ; $i++) { 
            Rolemenu::create([
                'id_menu' => $request->menu[$i],
                'id_user' => $request->user,
                'role' => $request->role[$i]
            ]);
        }
    }
}
