<?php

namespace App\Http\Controllers;

use App\Mail\Notificar;
use Illuminate\Http\Request;
//use Mail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller


{

    
    
        public function contacto(Request $request){
            $asunto = "Asunto del correo";//asunto
            $para = "oyecomova2023@gmail.com";//correo que lo recibe

            $notificar = new Notificar($request->input('name'), $request->input('msg'));
            
           // Mail::send(new Notificar(),$request->all(), function($msj) use($asunto,$para){
               // $msj->from("oyecomova2023@gmail.com","Oyecomova");
               // $msj->subject($asunto);
               // $msj->to($para);
            //});

            Mail::to($para)->send($notificar);
            
            return redirect()->back();
        }
    }



