<?php

namespace App\Http\Controllers;

use App\contact;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Mail\contact as ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }

    public function store(Request $request){
        // save mail in DB
        $contact = new contact();
        $contact->name = $request->post('name');
        $contact->email = $request->post('email');
        $contact->object = $request->post('object');
        $contact->message = $request->post('message');
        $contact->save();

        //Send mail
        $mail = [
                        'name'=>$contact->name,
                        'email'=>$contact->email,
                        'object'=>$contact->object,
                        'message'=>$contact->message
        ];
        Mail::send('contact.mailSend',
                    compact('mail'),
                    function($m) use($contact){
                        $m->from(env('MAIL_USERNAME', 'pikpinchart@gmail.com'));
                        // $m->to($contact->email);
                    }
            );

        // dispatch(new SendEmailJob($contact));

        Session::flash('message', 'Mail send'); 
        Session::flash('alert-class', 'alert-success'); 
        return back();
    }

    public function mailsReceive(){
        $emails = contact::select('*')->orderBy('created_at', 'DESC')->get();
        return view('contact.mailReceive', ['emails'=>$emails]);
    }
}
