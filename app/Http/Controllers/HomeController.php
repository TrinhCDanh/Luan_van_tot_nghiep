<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function sendmail() {
        $data = array('name'=>"Sam Jose", "body" => "Test mail");
        Mail::send('emails.mail', $data, function($message) {
            $message->to('trinhdanh04@gmail.com', 'Artisans Web')
                    ->subject('Artisans Web Testing Mail');
            $message->from('lmntrixno@gmail.com','Hello YOU');
        });
        return 'ok';
    }
}
