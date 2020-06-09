<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
use App\Order;
class TimerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        return view('timer');
    }

    public function order()
    {   
       
        date_default_timezone_set('Asia/Jakarta');
        $startTime = date("Y-m-d H:i:s");
        $cenvertedTime = date('Y-m-d H:i:s',strtotime('+0 hours +2 minutes +00 seconds',strtotime($startTime)));
        $order = new Order();
        $order->id_order = 1;
        $order->jml = 2;
        $order->tgl_order = $cenvertedTime;
        $order->user_id =  Auth::user()->id;
        $order->status_order =  "Belum bayar";
        $order->save();

        $tgl=$order->tgl_order;
       
         return view('timer',compact('tgl'));
       
    }

    public function list()
    {   
        
         $cek = Redis::keys('order-*-'.Auth::user()->id);
         if($cek){
             
            $n=[];
            foreach ($cek as $item) { 
                      $a = Redis::get('order-'.substr($item,23,2).'-'.Auth::user()->id);
                    //echo $item;
                    array_push($n,json_decode($a, true));
                }
                //$order = json_encode($n);
                
               echo($n[0]["id"]);  
           //return view('timer',compact('orders'));
         }else {
             $orders = Order::where('user_id', Auth::user()->id)->where('status_order','Belum bayar')->get();
                 if($orders!="[]"){
                    foreach($orders as $sid) {
                        Redis::set('order-'.$sid->id.'-'.Auth::user()->id, $sid);
                        }
                    return view('timer',compact('orders'));
                }else{
                    return view('timer',compact('orders'));
                }    
         }
        
    }

    public function updatestatus($id)
    {   
        $order= Order::find($id);
        if($order->user_id==Auth::user()->id){
            $order->status_order =  "Waktu habis";
            $order->save();
            Redis::del('order-*-'.Auth::user()->id);
            return $id;
        }

        $orders=Order::where('user_id', Auth::user()->id )->get();
      
        $tgl= $orders->tgl_order;

       
        return view('timer',compact('tgl'));
    }
}
