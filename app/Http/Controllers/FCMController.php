<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;


class FCMController extends Controller
{
    
    public function index()
    {
         $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
    $token='dORRDkcH_Vr8g8sJe42tUo:APA91bHm_RZ0B08SlTmfXxPAmkI3SzhoJ73QIGSaArgsf9M5tGuvpUIVKn0RSbJ1TP8d-WCWNQVEC6wjQ3v9S8p9hnkY-22TTrhArgkG11vDxoIVNg6uTNOtEfS20poyYiG-tYo3rPNE';

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


    dd($result);

            
    }

   


}
